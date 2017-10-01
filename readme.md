# laravel-amazon

大昔に作ったAmazon検索ツールをLaravelで作り直した。昔は時間かけて調べたけど今なら数時間で終わる。(2016)

https://abs.kawax.biz/

## CHANGELOG

Product Advertising API だけ使ってたけど他のAPIも使って機能追加していく。
 
### Login with Amazon 2017-09-13
https://login.amazon.com/

Amazonアカウントでログイン。現状はログインだけで他にはなにもない。

### APIパッケージ部分を分離 2017-09-15
https://github.com/kawax/laravel-amazon-product-api

### ブラウズリスト更新コマンド 2017-09-15
`php artisan abs:list`
ローカルで実行用。

### 履歴 2017-09-16
価格情報などの履歴を保存。変動チェックのための準備。

### ウォッチリスト 2017-09-16
Amazonアカウントでログインすると使える。

### Publisherなどから検索へリンク 2017-09-18
昔はタグとして個別ページを作ってた気がする。今はとりあえず簡易的な検索。

### Laravel Voyager で管理画面のテスト 2017-09-22

### アイテムのブラウズノードを保存 2017-09-23
特定のブラウズIDのアイテムだけをリスト化できるようにするための準備。JSONでそのまま保存してついでに他のデータも。

ブラウズリストにID表示。

### カテゴリーをウォッチリストに追加 2017-09-24
ASINでのアイテム単位とカテゴリー単位で。

### ホーム 2017-09-24
ランダムブラウズと最近見られてるアイテム。

ユーザーが増えればウォッチリストで人気のアイテム表示などもできる。

### カテゴリーのニューリリース 2017-09-25
ランキング(TopSellers)とニューリリースで切り替え。

### 履歴 2017-09-25
jsonでまとめてではなく個別のcolumnに。

10日で数GBなサイズになってるので減らす。

### CSVダウンロード 2017-09-26
カテゴリーでダウンロードしようとすると重すぎたのでDBを色々変更。
JSONでそのまま入れてるのを消したら2GBくらい大幅に減ってかなり軽くなった。

CSVまでできたのでしばらくは履歴データ増えるのを待つ。

### カテゴリー内のアイテム数 2017-09-30
普通に表示すると重すぎたので改善。

### ウォッチリスト内アイテムの情報更新 2017-09-30
確実に1日1回は更新されるように実行。ただし増えすぎた場合は減らす。

### グラフ 2017-10-01
Vue.jsで表示してるのでログイン中のみ。スマホサイズだと綺麗に表示できないので非表示。
