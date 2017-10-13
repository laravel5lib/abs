<?php

namespace App\Repository\Item;

use App\Model\Item;
use App\Model\Browse;

class EloquentItemRepository implements ItemRepositoryInterface
{
    /**
     * @var Item
     */
    protected $item;

    /**
     *
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @inheritDoc
     */
    public function show(string $asin)
    {
        $asin_item = $this->item->findOrFail($asin);

        $asin_item->load([
            'histories' => function ($query) {
                $query->latest()->limit(30);
            },
        ]);

        //        $asin_item->load('histories.availability');

        return $asin_item;
    }

    /**
     * @inheritDoc
     */
    public function recent()
    {
        $limit = 24;

        $recent = collect([]);

        $this->item->latest('updated_at')->with('browses')->chunk($limit, function ($items) use (&$recent, $limit) {
            foreach ($items as $item) {
                $browses = collect($item->browses)->whereIn('id', config('amazon.recent_except'));

                if (blank($browses)) {
                    $recent->push($item);
                }

                if ($recent->count() >= $limit) {
                    break;
                }
            }

            if ($recent->count() >= $limit) {
                return false;
            }
        });

        return $recent;
    }

    /**
     * @inheritDoc
     */
    public function oldCursor(int $limit = 100)
    {
        return $this->item->oldest('updated_at')
                          ->select('asin')
                          ->limit($limit)
                          ->cursor();
    }

    /**
     * @inheritDoc
     */
    public function histories(string $asin, int $limit)
    {
        return $this->item->findOrFail($asin)
                          ->histories()
                          ->latest('day')
                          ->limit($limit)
                          ->get();
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return $this->item->count('updated_at');
    }

    /**
     * @inheritDoc
     */
    public function create(array $item = null)
    {
        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return null;
        }

        $rank = array_get($item, 'SalesRank');
        $title = array_get($item, 'ItemAttributes.Title');
        $attributes = array_get($item, 'ItemAttributes');
        $offer_summary = array_get($item, 'OfferSummary');
        $offers = array_get($item, 'Offers');
        $image_sets = array_get($item, 'ImageSets');
        $large_image = array_get($item, 'LargeImage.URL');
        $detail_url = array_get($item, 'DetailPageURL');

        //        info($title);

        $new_item = $this->updateOrCreate([
            'asin' => $asin,
        ], compact([
            'title',
            'rank',
            'attributes',
            'offer_summary',
            'offers',
            'image_sets',
            'large_image',
            'detail_url',
        ]));

        return $new_item;
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

    /**
     * @inheritDoc
     */
    public function deleteCategory(int $browse_id, int $limit = 1000)
    {
        info('Delete Category: Start ' . $browse_id);

        $browseItems = Browse::findOrFail($browse_id)
                             ->browseItems()
                             ->limit($limit)
                             ->cursor();

        foreach ($browseItems as $browseItem) {
            $browseItem->delete();

            $item = $this->item->find($browseItem->item_asin);
            if (!empty($item) and $item->exists()) {
                //                info('Delete ASIN: ' . $item->asin . '/' . $item->title);

                $item->delete();

                cache()->forget('asin.' . $item->asin);
            }
        }

        info('Delete Category: End ' . $browse_id);
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(string $asin)
    {
        return $this->item->findOrFail($asin);
    }

    /**
     * @inheritDoc
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->item->updateOrCreate($attributes, $values);
    }
}
