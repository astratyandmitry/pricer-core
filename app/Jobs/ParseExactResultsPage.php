<?php

namespace App\Jobs;

use App\Models\Advert;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use PHPHtmlParser\Dom;

class ParseExactResultsPage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function handle()
    {
        $dom = (new Dom)->loadFromUrl($this->url);

        $domOffers = $dom->find('.offer');

        /** @var \PHPHtmlParser\Dom\Node\HtmlNode $domOffer */
        foreach ($domOffers as $domOffer) {
            if (! $aTag = $domOffer->find('a.link')[0]) {
                continue;
            }

            $priceStr = optional($domOffer->find('.price strong')[0])->text;

            if (! $priceValue = preg_replace('/[^0-9]/', '', $priceStr)) {
                continue;
            }

            $advertName = optional($aTag->find('strong')[0])->text;
            $advertUrl = $aTag->getAttribute('href');

            $advertUrl = preg_replace('/\.html.+/', '', $advertUrl) . '.html';

            if (! $advert = Advert::whereUrl($advertUrl)->first()) {
                $advert = Advert::create([
                    'title' => $advertName,
                    'url' => $advertUrl,
                    'price' => $priceValue,
                ]);
            } else {
                $advert->update([
                    'title' => $advertName,
                    'price' => $priceValue,
                ]);
            }

            $advert->updates()->create([
                'price' => $priceValue,
            ]);
        }
    }
}
