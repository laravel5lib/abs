<?php

namespace App\Jobs\Download;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\User;

use App\Http\Resources\Csv\Item as ItemResource;

use League\Csv\Writer;
use League\Csv\Exception;

use App\Notifications\CsvExported;

use Storage;

class ExportAsinJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info(self::class);

        \DB::disableQueryLog();

        $file_name = 'abs-asin-' . today()->toDateString() . '.csv';

        $path = 'csv/' . $this->user->id . '/';

        Storage::makeDirectory($path);

        try {
            $writer = Writer::createFromFileObject(new \SplTempFileObject());

            $writer->insertOne(config('amazon.csv_header'));

            $items = $this->user->watches()
                                ->with('item')
                                ->latest()
                                ->limit($this->user->csvLimit())
                                ->cursor();

            foreach ($items as $item) {
                $line = (new ItemResource($item->item))->toArray(request());

                $writer->insertOne($line);
            }

            Storage::put($path . $file_name, $writer->getContent());

            $this->user->notify(new CsvExported('CSVダウンロード(ASIN)', $file_name));
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}
