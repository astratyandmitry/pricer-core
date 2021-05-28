<?php

namespace App\Crawler;

use Illuminate\Support\Arr;
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

            $advertName = optional($aTag->find('strong')[0])->text;
            $advertImage = optional($offer->find('.photo-cell img'))->getAttribute('src');
            $advertUrl = $aTag->getAttribute('href');

            $advertUrl = preg_replace('/\.html.+/', '', $advertUrl).'.html';

            $adverts->push([
                'title' => $advertName,
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

        $lastPage =  $pagination[count($pagination) - 1];;

        return (int) optional($lastPage->find('span')[0])->text;
    }
}
