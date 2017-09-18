<?php
return [
    'analytics' => env('GOOGLE_ANALYTICS', ''),

    'redirect_from' => env('REDIRECT_FROM'),
    'redirect_to'   => env('REDIRECT_TO'),

    'form' => [
        'All'         => 'すべて',
        'Books'       => '本',
        'Music'       => 'ミュージック',
        'Electronics' => '家電&カメラ',
        'Appliances'  => '大型家電',
        'VideoGames'  => 'TVゲーム',

        'Apparel' => '服＆ファッション小物',

        'Toys' => 'おもちゃ',

        'Software'   => 'PCソフト',
        'PCHardware' => 'パソコン・周辺機器',

        'HealthPersonalCare' => 'ヘルス&ビューティー',
        'Beauty'             => 'コスメ',

        'Shoes'   => 'シューズ＆バッグ',
        'Jewelry' => 'ジュエリー',

        'Baby' => 'ベビー&マタニティ',

        'Hobbies' => 'ホビー',
    ],
];
