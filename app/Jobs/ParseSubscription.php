<?php

namespace App\Jobs;

use App\Crawler\Factory;
use App\Models\Subscription;
use Illuminate\Foundation\Bus\Dispatchable;

class ParseSubscription
{
    use Dispatchable;

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
        $crawler = Factory::make($this->subscription->marketplace);

        $crawler->parse(
            $this->subscription->url,
            $this->subscription->marketplace->proxy,
            $this->pageNumber
        );

        SyncParsedAdverts::dispatch($this->subscription, $crawler->adverts());

        $pagesCount = $crawler->pages();

        if ($this->pageNumber === null && $pagesCount > 1) {
            for ($pageNumber = 2; $pageNumber <= $pagesCount; $pageNumber++) {
                ParseSubscription::dispatch($this->subscription, $pageNumber);
            }
        }
    }
}
