<?php

namespace App\Crawler\Drivers;

interface Driver
{
    /**
     * @return string
     */
    public function domSelectorAdvert(): string;

    /**
     * @return string
     */
    public function domSelectorAdvertLink(): string;

    /**
     * @return string
     */
    public function domSelectorAdvertPrice(): string;

    /**
     * @return string
     */
    public function domSelectorAdvertImage(): string;

    /**
     * @param string $url
     * @return string
     */
    public function buildAdvertUrl(string $url): string;

    /**
     * @return string
     */
    public function domSelectorPagination(): string;
}
