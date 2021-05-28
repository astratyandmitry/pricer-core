<?php

namespace App\Crawler;

use Illuminate\Support\Collection;

class KolesaCrawler extends Crawler
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
        $offers = $this->dom->find('.vw-item');

        $adverts = collect();

        if (! count($offers)) {
            return $adverts;
        }

        /** @var \PHPHtmlParser\Dom\Node\HtmlNode $offer */
        foreach ($offers as $offer) {
            if (! $aTag = $offer->find('.a-el-info-title a.ddl_product_link')[0]) {
                continue;
            }

            $priceStr = optional($offer->find('.price')[0])->text;

            if (! $priceValue = preg_replace('/[^0-9]/', '', $priceStr)) {
                continue;
            }

            $advertImage = optional($offer->find('.a-elem__picture img')[0])->getAttribute('src');
            $advertUrl = "https://kolesa.kz{$aTag->getAttribute('href')}";

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
        $pagination = $this->dom->find('.pager li');

        if (count($pagination) <= 1) {
            return null;
        }

        $lastPage =  $pagination[count($pagination) - 1];;

        return (int) optional($lastPage->find('span')[0])->innerText;
    }
}
