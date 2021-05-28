<?php

namespace App\Crawler;

use Illuminate\Support\Collection;

class OlxCrawler extends Crawler
{
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
        $offers = $this->dom->find('.offer');

        $adverts = collect();

        if (! count($offers)) {
            return $adverts;
        }

        /** @var \PHPHtmlParser\Dom\Node\HtmlNode $offer */
        foreach ($offers as $offer) {
            if (! $aTag = $offer->find('a.link')[0]) {
                continue;
            }

            $priceStr = optional($offer->find('.price strong')[0])->text;

            if (! $priceValue = preg_replace('/[^0-9]/', '', $priceStr)) {
                continue;
            }

            $advertImage = optional($offer->find('.photo-cell img')[0])->getAttribute('src');
            $advertUrl = preg_replace('/\.html.+/', '', $aTag->getAttribute('href')).'.html';

            $adverts->push([
                'title' => $aTag->innerText,
                'image' => $advertImage,
                'url' => $advertUrl,
                'price' => $priceValue,
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
        $pagination = $this->dom->find('.pager .item');

        if (count($pagination) <= 1) {
            return null;
        }

        $lastPage = $pagination[count($pagination) - 1];

        return (int) $lastPage->innerText;
    }
}
