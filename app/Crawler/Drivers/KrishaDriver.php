<?php

namespace App\Crawler\Drivers;

class KrishaDriver implements Driver
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
        return '.a-card__title';
    }

    /**
     * @return string
     */
    public function domSelectorAdvertPrice(): string
    {
        return '.a-card__price';
    }

    /**
     * @return string
     */
    public function domSelectorAdvertImage(): string
    {
        return '.a-card__image img';
    }

    /**
     * @param string $url
     * @return string
     */
    public function buildAdvertUrl(string $url): string
    {
        return "https://krisha.kz{$url}";
    }

    /**
     * @return string
     */
    public function domSelectorPagination(): string
    {
        return '.paginator .paginator__btn';
    }
}
