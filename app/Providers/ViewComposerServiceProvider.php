<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use App\Http\ViewComposers\RandomBrowseViewComposer;
use App\Http\ViewComposers\ItemCountViewComposer;
use App\Http\ViewComposers\HistoryCountViewComposer;
use App\Http\ViewComposers\BrowseCountViewComposer;
use App\Http\ViewComposers\RecentItemViewComposer;
use App\Http\ViewComposers\PickupViewComposer;
use App\Http\ViewComposers\AsinWatchViewComposer;
use App\Http\ViewComposers\BrowseWatchViewComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('home.index', PickupViewComposer::class);

        View::composer('home.index', RandomBrowseViewComposer::class);

        View::composer('home.index', RecentItemViewComposer::class);

        View::composer('pages.usage', BrowseCountViewComposer::class);

        View::composer('pages.usage', ItemCountViewComposer::class);

        View::composer('pages.usage', HistoryCountViewComposer::class);

        View::composer(['watch.index', 'watch.asin.index'], AsinWatchViewComposer::class);

        View::composer(['watch.index', 'watch.browse.index'], BrowseWatchViewComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
