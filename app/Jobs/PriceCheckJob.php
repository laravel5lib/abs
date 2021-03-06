<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\Item;
use App\Model\Post;

use Notification;

use App\Notifications\WatchPriceAlertNotification;
use App\Notifications\PriceAlertNotification;

class PriceCheckJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * ジョブがタイムアウトになるまでの秒数
     *
     * @var int
     */
    public $timeout = 300;

    /**
     * @var Item
     */
    protected $item;

    /**
     * Create a new job instance.
     *
     * @param Item $item
     *
     * @return void
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (empty($this->item)) {
            return;
        }

        if ($this->item->histories->count() < 2) {
            return;
        }

        $slug = null;
        $category_id = null;

        $histories = $this->item->histories()->latest('day')->limit(2);

        $price = $histories->pluck('lowest_new_price');

        $price_today = (int)$price->first();
        $price_yesterday = (int)$price->last();

        if ($price_today == 0 or $price_yesterday == 0) {
            return;
        }

        $price_move = $price_today / $price_yesterday;

        //アップ
        if ($price_move >= 1.4) {
            $slug = 'up_' . $this->item->asin;
            $category_id = config('amazon.price_alert.up');
        }

        //ダウン
        if ($price_move <= 0.6) {
            $slug = 'down_' . $this->item->asin;
            $category_id = config('amazon.price_alert.down');
        }

        if (blank($slug)) {
            return;
        }

        //Postに追加
        /**
         * @var Post $post
         */
        $post = Post::updateOrCreate([
            'slug' => $slug,
        ], [
            'category_id' => $category_id,
            'title'       => abs_decode($this->item->title),
            'body'        => $price_yesterday . '円 => ' . $price_today . '円',
            'excerpt'     => $this->item->asin,
            'slug'        => $slug,
            'image'       => $this->item->large_image,
            'status'      => Post::PUBLISHED,
        ]);

        if (!$post->wasRecentlyCreated) {
            return;
        }

        if ($this->item->users()->count() > 0) {
            //ウォッチリスト版通知
            $post->fill(['author_id' => 0])->save();

            Notification::send(
                $this->item->users()->get(),
                new WatchPriceAlertNotification($post)
            );
        } else {
            //ホーム版通知
            $post->fill(['author_id' => 1])->save();

            $post->notify(new PriceAlertNotification());
        }
    }
}
