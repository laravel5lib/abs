<?php
return [
    /**
     * 機能スイッチ
     */


    /**
     * 非公開
     * 社内専用など非公開にしたい場合オン
     */
    'closed'          => env('FEATURE_CLOSED', false),

    /**
     * シングルユーザー
     * user id=1のみ有効。非公開と共に。
     */
    'single_user'     => env('FEATURE_SINGLE_USER', true),
    'single_user_id'  => env('FEATURE_SINGLE_USER_ID', 1),

    /**
     * ホームのランダムブラウズ
     * 自動でASIN情報を集めるので無駄なASINは不要な場合はオフ
     */
    'random_browse'   => env('FEATURE_RANDOM_BROWSE', true),

    /**
     * 除外リスト(amazon.delete_category)のカテゴリーのアイテム情報をDBから削除
     */
    'delete_category' => env('FEATURE_DELETE_CATEGORY', true),
];
