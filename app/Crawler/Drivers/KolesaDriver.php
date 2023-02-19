<?php

namespace App\Crawler\Drivers;

class KolesaDriver implements Driver
{
    /**
     * @return string
     */
    public function domSelectorAdvert(): string
    {
        return '.vw-item';
    }

    /**
     * @return string
     */
    public function domSelectorAdvertLink(): string
    {
        return '.a-el-info-title a.ddl_product_link';
    }

    /**
     * @return string
     */
    public function domSelectorAdvertPrice(): string
    {
        return '.price';
    }

    /**
     * @return string
     */
    public function domSelectorAdvertImage(): string
    {
        return '.a-elem__picture img';
    }

    /**
     * @param string $url
     * @return string
     */
    public function buildAdvertUrl(string $url): string
    {
        return "https://kolesa.kz{$url}";
    }

    /**
     * @return string
     */
    public function domSelectorPagination(): string
    {
        return '.pager li';
    }

    /**
     * @return string|null
     */
    public function domSelectorAdvertDescription(): ?string
    {
        return null;
    }
}
