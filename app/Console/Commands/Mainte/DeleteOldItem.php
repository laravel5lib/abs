<?php

namespace App\Console\Commands\Mainte;

use Illuminate\Console\Command;

use App\Repository\Item\ItemRepositoryInterface as Item;

class DeleteOldItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:delete-old-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '一定期間以上更新のないアイテムを削除';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param Item $repository
     *
     * @return mixed
     */
    public function handle(Item $repository)
    {
        $items = $repository->deleteOld(config('feature.delete_old_item_days'));

        info('Delete Old Item: ' . $items->count());

        $this->info($items->count());

        $items->delete();
    }
}
