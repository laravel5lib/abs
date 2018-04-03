# ABS
[![Build Status](https://travis-ci.org/kawax/abs.svg?branch=master)](https://travis-ci.org/kawax/abs)
[![Maintainability](https://api.codeclimate.com/v1/badges/f31fd5fe68d9d238aaac/maintainability)](https://codeclimate.com/github/kawax/abs/maintainability)

大昔に作ったAmazon検索ツールをLaravelで作り直した。昔は時間かけて調べたけど今なら数時間で終わる。(2016)

https://abs.kawax.biz/

## LICENSE
NO LICENSE

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

### DB を RDS に変更 2017-10-06
個人レベルでRDSは使いたくなかったけどデータ量多すぎてサーバーの負荷が上がって来たので分散。
1年は無料枠なので20GBまでなら大丈夫なはず。

### CSV 2017-10-17
データ量が多いとCSVダウンロードに時間がかかりすぎるので色々と対策。最終的にキューでCSVファイルを作って通知→ダウンロードという手順。そのままダウンロードしようとすると実行時間切れ。

### 価格変動チェック 2017-10-23
最近更新されたアイテムから一定数の範囲を調べて変動があれば通知。ホームとウォッチリストに入ってる場合はユーザーごとにも。
次の段階はウォッチリストを調べてユーザーに通知。Web Pushでの通知までは対応したい。メールは未定。

Postのcategory_idが2か3かで固定なのが微妙。

### Web Push 2017-10-26
プッシュ通知対応。ただし対応してるのはChromeとFirefoxのみのはず。

### メール通知 2017-11-01
mailgun を使うので使えるユーザー数は制限する。送信数が多くなりすぎるとここでも費用が必要になる。そこまでの段階になったらAWSのSESに変更するかもしれない。

### グラフ表示 2018-02-05
Vue.jsなのでGoogle botからは見えないだろうと非表示にしてたけど表示してみる。最近は認識できるようになってるという話も聞く。

### Laravel 5.6 2018-02-18
長期サポート版の5.5のままにするか迷ったけど5.6にアップデート。
メールでの通知を全員可能に。一時的にテスト。今後は送信数を見てから。

## インストールメモ
- `php artisan voyager:install` が途中で失敗するので残りのseedは手動で実行する。

```bash
php artisan db:seed --class=RolesTableSeeder
php artisan db:seed --class=PermissionsTableSeeder
php artisan db:seed --class=PermissionRoleTableSeede
sudo -u forge php artisan storage:link
```

menu_itemsは他からSQLでエクスポートして持ってくる。
