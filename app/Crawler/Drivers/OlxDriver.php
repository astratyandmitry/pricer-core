<?php

namespace App\Crawler\Drivers;

class OlxDriver implements Driver
{
    /**
     * @return string
     */
    public function domSelectorAdvert(): string
    {
        return '.offer';
    }

    /**
     * @return string
     */
    public function domSelectorAdvertLink(): string
    {
        return 'a.link';
    }

    /**
     * @return string
     */
    public function domSelectorAdvertPrice(): string
    {
        return '.price strong';
    }

    /**
     * @return string
     */
    public function domSelectorAdvertImage(): string
    {
        return '.photo-cell img';
    }

    /**
     * @param string $url
     * @return string
     */
    public function buildAdvertUrl(string $url): string
    {
        return preg_replace('/\.html.+/', '', $url).'.html';
    }

    /**
     * @return string
     */
    public function domSelectorPagination(): string
    {
        return '.pager .item';
    }

    /**
     * @return string|null
     */
    public function domSelectorAdvertDescription(): ?string
    {
        return null;
    }
}
