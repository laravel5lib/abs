<?php
return [
    'api_key'        => env('AMAZON_API_KEY', ''),
    'api_secret_key' => env('AMAZON_API_SECRET_KEY', ''),
    'associate_tag'  => env('AMAZON_ASSOCIATE_TAG', ''),
    'country'        => env('AMAZON_COUNTRY', 'co.jp'),

    'analytics' => env('GOOGLE_ANALYTICS', ''),

    'form' => [
        'All'         => 'すべて',
        'Books'       => '本',
        'Music'       => 'ミュージック',
        'Electronics' => '家電&カメラ',
        'Appliances'  => '大型家電	',
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

    'list' => [

        //'本 : 新刊' =>'466300' ,
        '本 : ベストセラー'         => '465610',
        '本 : コンピュータ・インターネット' => '466298',
        '本 : 新書・文庫'          => '466300',
        '本 : 実用・スポーツ・ホビー'    => '466292',
        '本 : 文学・評論'          => '466284',
        '本 : 人文・思想'          => '571582',
        '本 : 社会・政治'          => '571584',
        '本 : ノンフィクション'       => '492152',
        '本 : 歴史・地理'          => '466286',
        '本 : ビジネス・経済・キャリア'   => '466282',
        '本 : 投資・金融・会社経営'     => '492054',
        '本 : 科学・テクノロジー'      => '466290',
        '本 : 医学・薬学'          => '492166',
        '本 : ゲーム攻略本'         => '492266',
        '本 : コミック・アニメ・BL'    => '466280',
        //        '本 : 限定版・特装版'        => '13301021',
        '本 : 楽譜・スコア・音楽書'     => '746102',
        '本 : アート・建築・デザイン'    => '466294',
        '本 : 資格・検定'          => '492228',
        '本 : 旅行ガイド'          => '492090',
        '本 : 語学・辞事典・年鑑'      => '466302',
        '本 : 暮らし・健康・子育て'     => '466304',
        '本 : 教育・学参・受験'       => '3148931',
        '本 : こども'            => '466306',
        '本 : タレント写真集'        => '500592',
        '本 : 雑誌'             => '13384021',
        '本 : ポスター'           => '13383771',
        '本 : アダルト'           => '15826441',

        '洋書' => '52033011',
        //'洋書 : Biographies &amp; Memoirs' =>'2' ,
        //'洋書 : Business &amp; Investing' =>'3' ,
        //'洋書 : Children\'s Books' =>'4' ,
        //'洋書 : Comics &amp; Graphic Novels' =>'4366' ,
        //'洋書 : Computers &amp; Internet' =>'5' ,
        //'洋書 : Cooking, Food &amp; Wine' =>'6' ,
        //'洋書 : Entertainment' =>'86' ,
        //'洋書 : Health, Mind &amp; Body' =>'10' ,
        //'洋書 : History' =>'9' ,
        //'洋書 : Home &amp; Garden' =>'48' ,
        //'洋書 : Horror' =>'49' ,
        //'洋書 : Literature &amp; Fiction' =>'17' ,
        //'洋書 : Mystery &amp; Thrillers' =>'18' ,
        //'洋書 : Nonfiction' =>'53' ,
        //'洋書 : Outdoors &amp; Nature' =>'290060' ,
        //'洋書 : Parenting &amp; Families' =>'20' ,
        //'洋書 : Professional &amp; Technical' =>'173507' ,
        //'洋書 : Reference' =>'21' ,
        //'洋書 : Religion &amp; Spirituality' =>'22' ,
        //'洋書 : Romance' =>'23' ,
        //'洋書 : Science' =>'75' ,
        //'洋書 : Science Fiction &amp; Fantasy' =>'25' ,
        //'洋書 : Sports' =>'26' ,
        //'洋書 : Teens' =>'28' ,
        //'洋書 : Travel' =>'27' ,

        'ゲーム : ランキング'           => '637872',
        'ゲーム : Nintendo 3DS'    => '2225588051',
        'ゲーム : Wii U'           => '2279943051',
        'ゲーム : Nintendo Switch' => '4731377051',
        'ゲーム : プレイステーション4'      => '2494234051',
        'ゲーム : PS Vita'         => '2280006051',
        'ゲーム : Xbox One'        => '2540971051',
        'ゲーム : PCゲーム'           => '2515445051',
        'ゲーム : PCオンラインゲーム'      => '3312917051',
        'ゲーム : ダウンロード'          => '2510863051',

        //        'ソフトウェア : Mac'         => '3137861',
        'ソフトウェア : ゲーム'          => '689132',
        'ソフトウェア : セキュリティ'       => '1040116',
        'ソフトウェア : OS'           => '637666',
        'ソフトウェア : プログラミング'      => '637650',
        'ソフトウェア : ホームページ作成'     => '637648',
        'ソフトウェア : ビジネス・オフィス'    => '637644',
        'ソフトウェア : 英語学習'         => '1040098',
        'ソフトウェア : デザイン・グラフィック'  => '637652',
        //        'ソフトウェア : ランキング'       => '637674',
        'ソフトウェア : 会計・業務別'       => '1040106',
        //        'ソフトウェア : 教育・語学・翻訳'    => '637658',
        'ソフトウェア : アダルト'         => '927712',


        'エレクトロニクス : デジタルカメラ'        => '3371371',
        'エレクトロニクス : ポータブルオーディオ'     => '3371411',
        //        'エレクトロニクス : コンピュータ'         => '3371341',
        'エレクトロニクス : ノートパソコン'        => '2151981051',
        'エレクトロニクス : デスクトップパソコン'     => '2151949051',
        'エレクトロニクス : タブレットPC'        => '2152014051',
        'エレクトロニクス : ネットワーク'         => '2151984051',
        'エレクトロニクス : プリンタ・スキャナ'      => '2188763051',
        'エレクトロニクス : PCパーツ'          => '2151901051',
        //        'エレクトロニクス : PC周辺機器・パーツ'     => '3371351',
        'エレクトロニクス : DVDプレーヤー・レコーダー' => '3371441',
        //        'エレクトロニクス : オーディオ・ビジュアル'    => '3371431',
        //        'エレクトロニクス : Mac'            => '3481021',
        'エレクトロニクス : Apple'          => '13447861',
        'エレクトロニクス : アクセサリ・サプライ'     => '2151826051',
        'エレクトロニクス : 外付けドライブ・ストレージ'  => '2151950051',
        'エレクトロニクス : メモリーカード'        => '3481981',
        //        'エレクトロニクス : PDA・電子辞書'       => '3371401',


        'ミュージック : J-POP'          => '569170',
        //        'ミュージック : J-インディーズ'       => '569172',
        'ミュージック : ポップス'           => '569290',
        'ミュージック : ロック'            => '569292',
        //        'ミュージック : オルタナティヴロック'     => '569294',
        'ミュージック : ハードロック・ヘヴィーメタル' => '569298',
        'ミュージック : ブルース・カントリー'     => '562050',
        'ミュージック : ソウル・R&amp;B'    => '569318',
        'ミュージック : ヒップホップ'         => '569320',
        'ミュージック : ダンス・エレクトロニカ'    => '569322',
        'ミュージック : ジャズ・フュージョン'     => '562052',
        'ミュージック : クラシック'          => '701040',
        'ミュージック : ワールド'           => '562056',
        'ミュージック : ヒーリング・ニューエイジ'   => '562064',
        'ミュージック : サウンドトラック'       => '562058',
        'ミュージック : アニメ・ゲーム'        => '562060',
        'ミュージック : キッズ・ファミリー'      => '562062',
        'ミュージック : 歌謡曲・演歌'         => '569174',
        'ミュージック : 日本の伝統音楽・芸能'     => '569186',
        'ミュージック : スポーツ・その他'       => '899296',
        //        'ミュージック : プライスOFF国内盤'     => '3032511',
        //        'ミュージック : ランキング'          => '583332',


        'DVD : ランキング'       => '562012',
        'DVD : ブルーレイ'       => '403507011',
        'DVD : 日本映画'        => '562014',
        //        'DVD : 日本のTV・ドキュメンタリー' => '562028',
        'DVD : 外国映画'        => '562016',
        'DVD : ステージ'        => '12842321',
        'DVD : キッズ・ファミリー'   => '562026',
        'DVD : アニメ'         => '562020',
        'DVD : ミュージック'      => '562018',
        'DVD : お笑い・バラエティ'   => '12842371',
        'DVD : スポーツ・フィットネス' => '562024',
        'DVD : アイドル'        => '562030',
        'DVD : アダルト'        => '896246',


        'ホーム&amp;キッチン : ランキング'  => '3839151',
        'ホーム&amp;キッチン : キッチン用品' => '3895781',
        'ホーム&amp;キッチン : 調理機器'   => '3895771',
        'ホーム&amp;キッチン : 理美容グッズ' => '3895751',
        'ホーム&amp;キッチン : 健康グッズ'  => '3895741',
        'ホーム&amp;キッチン : 季節家電'   => '3895761',
        //        'ホーム&amp;キッチン : 消耗品・アクセサリ' => '3895801',


        'おもちゃ&amp;ホビー' => '13299531',
        //'おもちゃ&amp;ホビー : ランキング' =>'13323081' ,
        //        'おもちゃ&amp;ホビー : プラモデル'          => '13321841',
        //        'おもちゃ&amp;ホビー : ラジコン'           => '13321851',
        //        'おもちゃ&amp;ホビー : 赤ちゃん・幼児玩具'      => '13321461',
        //        'おもちゃ&amp;ホビー : パズル・ジグソーパズル'    => '13321721',
        //        'おもちゃ&amp;ホビー : アクションフィギュア・ソフビ' => '13321821',
        //        'おもちゃ&amp;ホビー : 人形・ミニドール'       => '13321731',
        //        'おもちゃ&amp;ホビー : ぬいぐるみ'          => '13321741',
        //        'おもちゃ&amp;ホビー : カード・ボードゲーム'     => '13321791',
        //        'おもちゃ&amp;ホビー : トレーディングカード'     => '13321801',
        //        'おもちゃ&amp;ホビー : ホビー : コレクターズ'   => '13367031',
        //        'おもちゃ&amp;ホビー : ホビー : フィギュア'    => '13366991',

        'ヘルス&amp;ビューティー : ドラッグストア'      => '160384011',
        'ヘルス&amp;ビューティー : ダイエット'        => '3396823051',
        'ヘルス&amp;ビューティー : アロマ・リラクゼーション' => '169874011',
        'ヘルス&amp;ビューティー : ビューティー'       => '170039011',
        //        'ヘルス&amp;ビューティー : 飲料・ソフトドリンク'   => '178892011',
        //        'ヘルス&amp;ビューティー : サプリメント'       => '179492011',
        //        'ヘルス&amp;ビューティー : ボディケア'        => '169844011',
        //        'ヘルス&amp;ビューティー : マッサージオイル'     => '169881011',
        //        'ヘルス&amp;ビューティー : コンタクトケア用品'    => '169921011',
        //        'ヘルス&amp;ビューティー : ドリンク・食品'      => '170681011',
        'ヘルス&amp;ビューティー : 医薬品'          => '2505532051',
        'ヘルス&amp;ビューティー : 衛生用品・ヘルスケア'   => '169911011',
        'ヘルス&amp;ビューティー : アダルトグッズ'      => '171288011',

        'ベビー&amp;マタニティ' => '344845011',

        'スポーツ&amp;アウトドア' => '14304371',

        'ジュエリー'       => '85895051',
        'ネックレス＆ペンダント' => '86228051',
        'ピアス＆イヤリング'   => '86255051',
        'メンズアクセサリー'   => '86246051',

        'シューズ &amp; バッグ' => '2016926051',

        'DIY・工具' => '2016929051',

        'Kindleストア'   => '2250738051',
        'Kindle本'     => '2275256051',
        'Kindle コミック' => '2293143051',
        'Kindle 雑誌'   => '2275257051',

        '食品・飲料・お酒' => '57239051',
        '食品'       => '70903051',
        'お酒'       => '71588051',

        'レディースファッション' => '2230006051',
        'メンズファッション'   => '2230005051',
        '腕時計'         => '324025011',

        'Amazonビデオ' => '2351649051',

    ],
];
