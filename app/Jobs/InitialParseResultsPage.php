<?php

namespace App\Jobs;

use App\Models\Advert;
use App\Models\Query;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use PHPHtmlParser\Dom;

class InitialParseResultsPage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\Query
     */
    private $query;

    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    public function handle()
    {
        $dom = (new Dom)->loadFromUrl($this->query->results_url);

        $domLastPage = $dom->find('.pager .item');

        if (! count($domLastPage)) {
            return;
        }

        $domLastPage = $domLastPage[count($domLastPage) - 1];
        $lastPageValue = (int) optional($domLastPage->find('span')[0])->text;

        for ($i = 1; $i <= $lastPageValue ?? 1; $i++) {
            $resultsUrl = $this->query->results_url;
            $resultsUrl .= (Str::contains($this->query->results_url, '?') ? "&page={$i}" : "?page={$i}");

            ParseExactResultsPage::dispatch($resultsUrl);
        }
    }
}
