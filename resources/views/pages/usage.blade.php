@extends('layouts.master')

@section('title', '使い方' . ' | ')

@section('content')

  @include('home.form')

  <h2 class="uk-heading-divider">使い方</h2>

  （未完成版）

  <h3>Amazonアカウントでログイン</h3>

  <p>Login with Amazonを使ってAmazonアカウントでログインしてユーザー登録できます。よくあるTwitterでログインと同じです。ユーザー登録に使うだけなのでAmazon側になにか影響することはありません。</p>

  <h3>ウォッチリスト</h3>

  <p>ASINやカテゴリーを指定してウォッチリストに追加できます。</p>

  <p>ウォッチリストに追加したアイテムは1日1回は商品情報が更新されます。</p>

  <h3>カテゴリーをウォッチリストに追加</h3>

  <p><a href="{{ route('browselist') }}">ブラウズリスト</a>にあるカテゴリーはそのまま表示して追加できますがリストにないカテゴリーも追加できます。</p>

  <p>例：Amazonで本カテゴリーのURL https://www.amazon.co.jp/%E6%9C%AC-%E9%80%9A%E8%B2%A9/b/?ie=UTF8&node=465392
    これの<code>node=</code>の後ろがIDになるので https://abs.kawax.biz/browse/ にIDを付けて https://abs.kawax.biz/browse/465392
    で表示するとウォッチリストに追加できます。
  </p>

  <p>ID指定しても表示できないカテゴリーもあります。</p>

  <h3>価格変動チェック</h3>

  <p>条件は仮。</p>

  <h4>ホームに表示版</h4>

  <p>最近更新されたアイテムから一定数の範囲を調査。ランキング1000位以内。履歴の価格が前回と比べて一定割合以上増減してる場合に通知。</p>

  <h4>ウォッチリスト版</h4>

  <p>条件は同じでウォッチリストのアイテム全部を調査。通知先は各ユーザーの通知ページ。</p>

  <p><a href="/notifications" rel="nofollow">ウェブプッシュ通知</a>を有効にするとブラウザを起動していればいつでも通知されます。対応しているのは一部ブラウザのみ。通知ページからテストできます。何も起きなければ非対応。</p>

  <div class="uk-child-width-1-2@m" uk-grid>
    <div class="uk-margin">
      <img src="{{ asset('image/web_push.png') }}" alt="Web Push" class="uk-border-rounded uk-box-shadow-large">
    </div>
  </div>

  <p><del>メールでの通知は有料プランのみ対応。</del></p>

  <h3>CSVファイルでダウンロード</h3>

  <p>ウォッチリストに追加したアイテムの商品情報をCSVでダウンロードできます。</p>

  <p>現在は100件〜プラン次第で無制限まで。CSVに含める項目や件数はいくらでも変更できるので需要次第。</p>

  <h3>グラフ</h3>

  <p>価格・ランキング・出品数のグラフ。ログイン中のユーザーにしか表示されません。スマホサイズでは綺麗に表示できないので非表示。</p>

  <div class="uk-child-width-1-2@m" uk-grid>
    <div class="uk-margin">
      <img src="{{ asset('image/usage_graph.jpg') }}" alt="" class="uk-border-rounded uk-box-shadow-large uk-padding">
    </div>
  </div>

  <h3>禁止行為</h3>

  <p>当サイトに対するスクレイピングは禁止します。AmazonのAPI使えばいいだけのこと。</p>

  <h3>機能スイッチ</h3>

  <table class="uk-table uk-table-striped uk-table-hover uk-table-divider">
    <tbody>
    <tr>
      <th>CSVダウンロード</th>
      <td>{{ config('feature.csv_download') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>価格変動チェック</th>
      <td>{{ config('feature.price_alert') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>価格変動チェックをメールで通知</th>
      <td>{{ config('feature.notify_mail') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>高速版価格変動チェック</th>
      <td>{{ config('feature.price_alert_express') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>ランダムブラウズ</th>
      <td>{{ config('feature.random_browse') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>最近のアイテム</th>
      <td>{{ config('feature.recent_item') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>ウォッチリストのアイテムを1日1回更新</th>
      <td>{{ config('feature.watch_item') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>更新日の古いアイテムを更新</th>
      <td>{{ config('feature.update_old_item') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>一定期間更新のないアイテムを削除</th>
      <td>{{ config('feature.delete_old_item') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>除外カテゴリーのアイテムを削除</th>
      <td>{{ config('feature.delete_category') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>ASIN/JAN(EAN)リストのCSVファイルをウォッチリストへインポート</th>
      <td>{{ config('feature.csv_import') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>ワールド</th>
      <td>{{ config('feature.world') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>プラン</th>
      <td>{{ config('feature.plan') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>非公開モード</th>
      <td>{{ config('feature.closed') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>シングルユーザーモード</th>
      <td>{{ config('feature.single_user') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>ゲストログイン</th>
      <td>{{ config('feature.password_login') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>CSVにImageSetsを含める</th>
      <td>{{ config('feature.image_sets') ? 'ON' : 'OFF' }}</td>
    </tr>
    <tr>
      <th>API</th>
      <td>{{ config('feature.api') ? 'ON' : 'OFF' }}</td>
    </tr>

    </tbody>
  </table>

@endsection
