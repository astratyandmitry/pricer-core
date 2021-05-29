<?php

namespace App\Crawler\Drivers;

use App\Models\Marketplace;

class Factory
{
    /**
     * @param \App\Models\Marketplace $marketplace
     * @return \App\Crawler\Drivers\Driver
     */
    public static function make(Marketplace $marketplace): Driver
    {
        $driverClassName = 'App\\Crawler\\Drivers\\'.ucfirst($marketplace->key).'Driver';

        return new $driverClassName;
    }
}
