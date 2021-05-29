<?php

namespace App\Crawler\Drivers;

class MarketDriver implements Driver
{
    /**
     * @return string
     */
    public function domSelectorAdvert(): string
    {
        return '.a-card';
    }

    /**
     * @return string
     */
    public function domSelectorAdvertLink(): string
    {
        return '.a-card__title a';
    }

    /**
     * @return string
     */
    public function domSelectorAdvertPrice(): string
    {
        return '.a-card__price .rate-1';
    }

    /**
     * @return string
     */
    public function domSelectorAdvertImage(): string
    {
        return '.a-card__photo img';
    }

    /**
     * @param string $url
     * @return string
     */
    public function buildAdvertUrl(string $url): string
    {
        return $url;
    }

    /**
     * @return string
     */
    public function domSelectorPagination(): string
    {
        return '.pagination li';
    }
}
