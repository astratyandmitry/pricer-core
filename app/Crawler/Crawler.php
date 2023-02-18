<?php

namespace App\Crawler;

use PHPHtmlParser\Dom;
use Illuminate\Support\Str;
use App\Models\CrawlerProxy;
use App\Models\CrawlerBrowser;
use App\Crawler\Drivers\Driver;
use Illuminate\Support\Collection;

class Crawler
{
    /**
     * @var \App\Crawler\Drivers\Driver
     */
    private $driver;

    /**
     * @var \PHPHtmlParser\Dom
     */
    protected $dom;

    /**
     * @var \App\Models\CrawlerBrowser
     */
    private $browser;

    /**
     * @var \App\Models\CrawlerProxy
     */
    private $proxy;

    /**
     * @param \App\Crawler\Drivers\Driver $driver
     * @param bool $proxy
     */
    public function __construct(Driver $driver, bool $proxy = false)
    {
        $this->driver = $driver;
        $this->browser = CrawlerBrowser::query()->inRandomOrder()->first();

        if ($proxy) {
            $this->proxy = CrawlerProxy::query()->whereDate('expired_at', '>', now())->inRandomOrder()->first();
        }
    }

    /**
     * @param string $url
     * @param int|null $page
     * @return \App\Crawler\Crawler
     * @throws \PHPHtmlParser\Exceptions\ChildNotFoundException
     * @throws \PHPHtmlParser\Exceptions\CircularException
     * @throws \PHPHtmlParser\Exceptions\ContentLengthException
     * @throws \PHPHtmlParser\Exceptions\LogicalException
     * @throws \PHPHtmlParser\Exceptions\StrictException
     */
    public function parse(string $url, ?int $page = null): Crawler
    {
        if ($page !== null && $page > 1) {
            $url = (Str::contains($url, '?') ? "{$url}&page={$page}" : "{$url}?page={$page}");
        }

        $this->dom = (new Dom)->loadStr($this->getHtml($url));

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \PHPHtmlParser\Exceptions\ChildNotFoundException
     * @throws \PHPHtmlParser\Exceptions\CircularException
     * @throws \PHPHtmlParser\Exceptions\ContentLengthException
     * @throws \PHPHtmlParser\Exceptions\LogicalException
     * @throws \PHPHtmlParser\Exceptions\NotLoadedException
     * @throws \PHPHtmlParser\Exceptions\StrictException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function adverts(): Collection
    {
        /** @var \PHPHtmlParser\Dom\Node\Collection $domOffers */
        $domOffers = $this->dom->find(
            $this->driver->domSelectorAdvert()
        );

        $adverts = collect();

        if (! $domOffers->count()) {
            return $adverts;
        }

        /** @var \PHPHtmlParser\Dom\Node\HtmlNode $domOffer */
        foreach ($domOffers as $domOffer) {
            /** @var \PHPHtmlParser\Dom\Node\HtmlNode $domOfferLink */
            $domOfferLink = $domOffer->find($this->driver->domSelectorAdvertLink())[0];

            /** @var \PHPHtmlParser\Dom\Node\HtmlNode $domOfferPrice */
            $domOfferPrice = $domOffer->find($this->driver->domSelectorAdvertPrice())[0];

            if (! $domOfferLink || ! $domOfferPrice) {
                continue;
            }

            if (! $price = preg_replace('/[^0-9]/', '', $domOfferPrice->text)) {
                continue;
            }

            /** @var \PHPHtmlParser\Dom\Node\HtmlNode $domOfferImage */
            $domOfferImage = $domOffer->find($this->driver->domSelectorAdvertImage())[0];

            $adverts->push([
                'url' => $this->driver->buildAdvertUrl($domOfferLink->getAttribute('href')),
                'image' => $domOfferImage ? $domOfferImage->getAttribute('src') : null,
                'title' => $domOfferLink->innerText,
                'price' => $price,
            ]);
        }

        return $adverts;
    }

    /**
     * @return int
     * @throws \PHPHtmlParser\Exceptions\ChildNotFoundException
     * @throws \PHPHtmlParser\Exceptions\NotLoadedException
     */
    public function pages(): ?int
    {
        /** @var \PHPHtmlParser\Dom\Node\Collection $domPagination */
        $domPagination = $this->dom->find(
            $this->driver->domSelectorPagination()
        );

        if ($domPagination->count() <= 1) {
            return null;
        }

        /** @var \PHPHtmlParser\Dom\Node\HtmlNode $domPaginationLastChild */
        $domPaginationLastChild = $domPagination[count($domPagination) - 2];

        return (int) $domPaginationLastChild->innerText;
    }

    /**
     * @param string $url
     * @return string
     */
    private function getHtml(string $url): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->browser->useragent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if ($this->proxy) {
            curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTPS');
            curl_setopt($ch, CURLOPT_PROXY, $this->proxy->ip);
            curl_setopt($ch, CURLOPT_PROXYPORT, $this->proxy->port);
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, "{$this->proxy->username}:{$this->proxy->password}");
        }

        $html = curl_exec($ch);

        curl_close($ch);

        return $html;
    }
}
