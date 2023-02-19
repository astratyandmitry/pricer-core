<?php

namespace App\Jobs;

use App\Models\Advert;
use App\Models\AdvertToSubscription;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncParsedAdverts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\Subscription
     */
    private $subscription;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $adverts;

    /**
     * @param \App\Models\Subscription $subscription
     * @param \Illuminate\Support\Collection $adverts
     */
    public function __construct(Subscription $subscription, Collection $adverts)
    {
        $this->subscription = $subscription;
        $this->adverts = $adverts;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        if ($this->adverts->isEmpty()) {
            return;
        }

        foreach ($this->adverts as $data) {
            if ($advert = $this->getAdvertByUrl($data['url'])) {
                if (! $advert->trashed()) {
                    $advert->update([
                        'title' => $data['title'],
                        'image' => $data['image'],
                    ]);
                }
            } else {
                $advert = $this->storeAdvert($data);
            }

            $this->addAdvertToSubscription($advert);

            LogAdvertUpdate::dispatchNow($advert, $data['price']);
        }
    }

    /**
     * @param string $url
     * @return \App\Models\Advert|null
     */
    private function getAdvertByUrl(string $url): ?Advert
    {
        return Advert::query()->where([
            'marketplace_key' => $this->subscription->marketplace_key,
            'url' => $url,
        ])->withTrashed()->first();
    }

    /**
     * @param array $data
     * @return \App\Models\Advert
     */
    private function storeAdvert(array $data): Advert
    {
        return Advert::query()->create([
            'marketplace_key' => $this->subscription->marketplace_key,
            'title' => $data['title'],
            'description' => $data['description'],
            'url' => $data['url'],
            'image' => $data['image'],
        ]);
    }

    /**
     * @param \App\Models\Advert $advert
     * @return void
     */
    private function addAdvertToSubscription(Advert $advert): void
    {
        AdvertToSubscription::query()->firstOrCreate([
            'subscription_id' => $this->subscription->id,
            'advert_id' => $advert->id,
        ]);
    }
}
