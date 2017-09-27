<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use AmazonProduct;
use App\Model\Item;
use App\Model\History;

class ItemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $asin;

    /**
     * Create a new job instance.
     *
     * @param string $asin
     *
     */
    public function __construct(string $asin)
    {
        $this->asin = $asin;
    }

    /**
     * Execute the job.
     *
     * @return array
     */
    public function handle(): array
    {
        $item = cache()->remember('asin.' . $this->asin, 60, function () {
            return rescue(function () {
                $results = AmazonProduct::item($this->asin);
                $item = array_get($results, 'Items.Item', []);

                if (!empty($item)) {
                    $this->createItem($item);
                    $this->createHistory($item);
                }

                return $item;
            });
        });

        if (is_null($item)) {
            $item = [];
        }

        return $item;
    }

    /**
     * @param array $item
     */
    public function createItem(array $item)
    {
        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return;
        }

        $title = array_get($item, 'ItemAttributes.Title');
        $attributes = array_get($item, 'ItemAttributes');
        $offer_summary = array_get($item, 'OfferSummary');
        $offers = array_get($item, 'Offers');
        $image_sets = array_get($item, 'ImageSets');
        $large_image = array_get($item, 'LargeImage.URL');
        $detail_url = array_get($item, 'DetailPageURL');


        $new_item = Item::updateOrCreate([
            'asin' => $asin,
        ], compact([
            'asin',
            'title',
            'attributes',
            'offer_summary',
            'offers',
            'image_sets',
            'large_image',
            'detail_url',
        ]));

        $browse_nodes = $this->browseNodes($item);

        $new_item->browses()->sync($browse_nodes);
    }

    /**
     * @param array $item
     */
    private function createHistory(array $item)
    {
        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return;
        }

        $day = today();

        $rank = array_get($item, 'SalesRank');
        $availability = array_get($item, 'Offers.Offer.OfferListing.Availability');
        $lowest_new_price = array_get($item, 'OfferSummary.LowestNewPrice.Amount');
        $lowest_used_price = array_get($item, 'OfferSummary.LowestUsedPrice.Amount');
        $total_new = array_get($item, 'OfferSummary.TotalNew');
        $total_used = array_get($item, 'OfferSummary.TotalUsed');

        $history = History::updateOrCreate([
            'asin_id' => $asin,
            'day'     => $day,
        ], compact([
            'asin_id',
            'day',
            'rank',
            'availability',
            'lowest_new_price',
            'lowest_used_price',
            'total_new',
            'total_used',
        ]));
    }

    /**
     * @param array $item
     *
     * @return array
     */
    private function browseNodes(array $item): array
    {
        $ids = [];
        $nodes = array_get($item, 'BrowseNodes');

        while ($nodes = array_get($nodes, 'BrowseNode')) {
            if (!array_has($nodes, 'BrowseNodeId')) {
                $nodes = head($nodes);
            }

            $ids[] = (int)array_get($nodes, 'BrowseNodeId');

            $nodes = array_get($nodes, 'Ancestors');
        }

        return $ids;
    }
}
