<?php

namespace App\Crawler;

use App\Models\Marketplace;

class Factory
{
    /**
     * @param \App\Models\Marketplace $marketplace
     * @return \App\Crawler\Crawler
     */
    public static function make(Marketplace $marketplace): Crawler
    {
        $driverClassName = 'App\\Crawler\\'.ucfirst($marketplace->key).'Crawler';

        return new $driverClassName;
    }
}
