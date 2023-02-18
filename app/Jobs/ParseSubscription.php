<?php

namespace App\Jobs;

use App\Crawler\Crawler;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use App\Crawler\Drivers\Factory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ParseSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\Subscription
     */
    private $subscription;

    /**
     * @var int|null
     */
    private $pageNumber;

    /**
     * @param \App\Models\Subscription $subscription
     * @param int|null $pageNumber
     */
    public function __construct(Subscription $subscription, ?int $pageNumber = null)
    {
        $this->subscription = $subscription;
        $this->pageNumber = $pageNumber;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $driver = Factory::make($this->subscription->marketplace);

        $crawler = new Crawler($driver, $this->subscription->marketplace->proxy);
        $crawler->parse($this->subscription->url, $this->pageNumber);

        SyncParsedAdverts::dispatchNow($this->subscription, $crawler->adverts());

        $pagesCount = $crawler->pages();


        if ($this->pageNumber === null && $pagesCount > 1) {
            for ($pageNumber = 2; $pageNumber <= $pagesCount; $pageNumber++) {
                ParseSubscription::dispatchNow($this->subscription, $pageNumber);
            }
        }
    }
}
