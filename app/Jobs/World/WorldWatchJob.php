<?php

namespace App\Jobs\World;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\WorldItem;
use App\Model\Binding;
use App\Model\Availability;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

use Revolution\Amazon\ProductAdvertising\AmazonClient;

use ApaiIO\ApaiIO;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Request\GuzzleRequest;
use ApaiIO\ResponseTransformer\XmlToArray;
use GuzzleHttp\Client;

use App\Repository\Browse\BrowseRepositoryInterface as Browse;

class WorldWatchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $asins;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var AmazonClient
     */
    protected $amazon;

    /**
     * Create a new job instance.
     *
     * @param array  $asins
     * @param string $locale
     *
     */
    public function __construct(array $asins, string $locale = 'JP')
    {
        $this->asins = $asins;
        $this->locale = $locale;
    }

    /**
     * Execute the job.
     *
     * @param Browse $browseRepository
     *
     * @return void
     */
    public function handle(Browse $browseRepository)
    {
        info(self::class);

        if (empty($this->asins)) {
            return;
        }

        if (count($this->asins) > 10) {
            return;
        }

        $this->amazon = $this->factory();

        $items = $this->get();

        if (empty($items)) {
            return;
        }

        foreach ($items as $item) {
            if (!is_array($item)) {
                continue;
            }

            $world_item = $this->create($item);
            if (empty($world_item)) {
                continue;
            }

            $browse_nodes = browse_nodes($item);
            if (!empty($browse_nodes)) {
                $browseRepository->createNodes($browse_nodes);

                $world_item->browses()->sync(array_values($browse_nodes));
            }
        }
    }

    /**
     * @return array
     */
    public function get()
    {
        //        try {
        //            $results = $this->amazon->setIdType('ASIN')->items($this->asins);
        //        } catch (ClientException $e) {
        //            logger()->error($e->getResponse()->getBody());
        //            $results = [];
        //        } catch (RequestException $e) {
        //            logger()->error($e->getResponse()->getBody());
        //            $results = [];
        //        }

        $results = rescue(function () {
            return $this->amazon->setIdType('ASIN')->items($this->asins);
        }, []);

        $items = array_get($results, 'Items.Item', []);
        if (count($this->asins) === 1) {
            $items = [$items];
        }

        return $items;
    }

    /**
     * @param array|null $item
     *
     * @return WorldItem|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(array $item = null)
    {
        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return null;
        }

        $ean = array_get($item, 'ItemAttributes.EAN');

        $rank = array_get($item, 'SalesRank');
        $title = array_get($item, 'ItemAttributes.Title');

        $lowest_new_price = array_get($item, 'OfferSummary.LowestNewPrice.Amount');
        $lowest_new_formatted_price = array_get($item, 'OfferSummary.LowestNewPrice.FormattedPrice');

        $lowest_used_price = array_get($item, 'OfferSummary.LowestUsedPrice.Amount');
        $lowest_used_formatted_price = array_get($item, 'OfferSummary.LowestUsedPrice.FormattedPrice');

        $total_new = array_get($item, 'OfferSummary.TotalNew');
        $total_used = array_get($item, 'OfferSummary.TotalUsed');
        $editorial_review = array_get($item, 'EditorialReviews.EditorialReview.Content');


        /**
         * @var WorldItem $world_item
         */
        $world_item = WorldItem::updateOrCreate([
            'asin'    => $asin,
            'country' => $this->locale,
        ], compact([
            'ean',
            'title',
            'rank',
            'lowest_new_price',
            'lowest_new_formatted_price',
            'lowest_used_price',
            'lowest_used_formatted_price',
            'total_new',
            'total_used',
            'editorial_review',
        ]));

        //Availability
        $availability = array_get($item, 'Offers.Offer.OfferListing.Availability', '');
        $ava = Availability::firstOrCreate(compact('availability'));
        $world_item->availability()->associate($ava);

        //Binding
        $binding = array_get($item, 'ItemAttributes.Binding');

        if (!empty($binding)) {
            $bind = Binding::firstOrCreate(compact('binding'));
            $world_item->binding()->associate($bind);
        }

        $world_item->save();

        return $world_item;
    }

    /**
     * @return AmazonClient
     */
    private function factory()
    {
        $client = new Client();

        $request = new GuzzleRequest($client);
        $request->setScheme('https');

        $world_config = config('amazon-world.locales.' . $this->locale);
        info($world_config);

        $conf = new GenericConfiguration();

        $conf->setCountry(array_get($world_config, 'tld'))
             ->setAccessKey(array_get($world_config, 'api_key'))
             ->setSecretKey(array_get($world_config, 'api_secret'))
             ->setAssociateTag(array_get($world_config, 'tag'))
             ->setResponseTransformer(new XmlToArray())
             ->setRequest($request);

        $apaiio = new ApaiIO($conf);

        return new AmazonClient($apaiio);
    }
}
