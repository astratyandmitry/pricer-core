<?php

use Illuminate\Support\Str;

/**
 * @param float $old
 * @param float $new
 * @return float
 */
function diff_percentage(float $old, float $new): float
{
    return (float) (1 - $old / $new) * 100;
}

/**
 * @param string $str
 * @param int $limit
 * @return string
 */
function shorten(string $str, int $limit = 80): string
{
    if (Str::length($str) > $limit) {
        return Str::substr($str, 0, $limit).'...';
    }

    return $str;
}

/**
 * @param float $sum
 * @param bool $prependSymbol
 * @return string
 */
function price(float $sum, bool $prependSymbol = true): string
{
    $price = number_format($sum);

    if ($prependSymbol) {
        return "{$price} ₸";
    }

    return $price;
}
