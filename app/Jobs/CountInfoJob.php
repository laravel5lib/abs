<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\History;
use App\Model\Item;
use App\Model\Browse;
use App\Model\User;

use App\Notifications\CountInfoNotification;

class CountInfoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 最大試行回数
     *
     * @var int
     */
    public $tries = 1;

    /**
     * ジョブがタイムアウトになるまでの秒数
     *
     * @var int
     */
    public $timeout = 120;

    /**
     * @var bool
     */
    protected $notify;

    /**
     * Create a new job instance.
     *
     * @param bool $notify
     *
     * @return void
     */
    public function __construct(bool $notify)
    {
        $this->notify = $notify;
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function handle()
    {
        $user_count = User::count();
        info('User count: ' . $user_count);
        cache()->forever('user_count', $user_count);

        $browses_count = Browse::count();
        info('Browse count: ' . $browses_count);
        cache()->forever('browses_count', $browses_count);

        $items_count = Item::count();
        info('Item count: ' . $items_count);
        cache()->forever('items_count', $items_count);

        $histories_count = History::count();
        info('History count: ' . $histories_count);
        cache()->forever('histories_count', $histories_count);

        if ($this->notify) {
            User::find(1)->notify(new CountInfoNotification(compact([
                    'items_count',
                    'histories_count',
                    'browses_count',
                    'user_count',
                ]))
            );
        }
    }
}
