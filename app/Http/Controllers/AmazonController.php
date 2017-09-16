<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use AmazonProduct;

class AmazonController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //トップページは後で変更

        $lists = collect(config('amazon-browse'));
        $node = $lists->random();

        $result = AmazonProduct::browse($node);

        $nodes = array_get($result, 'BrowseNodes');
        $browse_name = array_get($nodes, 'BrowseNode.Name');

        $items = array_get($nodes, 'BrowseNode.TopSellers.TopSeller');
        $items = collect($items)->pluck('ASIN');
        $results = AmazonProduct::items($items->toArray());

        $items = array_get($results, 'Items.Item');

        return view('browse.index')->with(compact('items', 'browse_name', 'browse'));
    }
}
