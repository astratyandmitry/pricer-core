<?php

namespace App\Crawler;

use PHPHtmlParser\Dom;
use Illuminate\Support\Str;
use App\Models\CrawlerProxy;
use App\Models\CrawlerBrowser;
use Illuminate\Support\Collection;

abstract class Crawler
{
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
     * @return void
     */
    public function __construct()
    {
        $this->browser = CrawlerBrowser::query()->inRandomOrder()->first();
        $this->proxy = CrawlerProxy::query()->inRandomOrder()->first();
    }

    /**
     * @param string $url
     * @param bool $usesProxy
     * @param int|null $page
     * @return \App\Crawler\Crawler
     * @throws \PHPHtmlParser\Exceptions\ChildNotFoundException
     * @throws \PHPHtmlParser\Exceptions\CircularException
     * @throws \PHPHtmlParser\Exceptions\ContentLengthException
     * @throws \PHPHtmlParser\Exceptions\LogicalException
     * @throws \PHPHtmlParser\Exceptions\StrictException
     */
    public function parse(string $url, bool $usesProxy = false, ?int $page = null): Crawler
    {
        if ($page !== null && $page > 1) {
            $url = (Str::contains($url, '?') ? "{$url}&page={$page}" : "{$url}?page={$page}");
        }

        $this->dom = (new Dom)->loadStr($this->getHtml($url, $usesProxy));

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
    abstract public function adverts(): Collection;

    /**
     * @return int|null
     * @throws \PHPHtmlParser\Exceptions\ChildNotFoundException
     * @throws \PHPHtmlParser\Exceptions\NotLoadedException
     */
    abstract public function pages(): ?int;

    /**
     * @param string $url
     * @param bool $usesProxy
     * @return string
     */
    private function getHtml(string $url, bool $usesProxy = false): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->browser->useragent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if ($usesProxy === true) {
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
