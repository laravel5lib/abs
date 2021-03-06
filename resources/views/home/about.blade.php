<div class="uk-card uk-card-default uk-card-body">
  <h2 class="uk-card-title">このサイトについて</h2>
  <p>
    Amazon Product Advertising APIのデモサイトとして検索機能だけ使えるようにしてましたが現在は徐々に機能追加中。10-15年くらい使ってたURLも変更。
  </p>

  <p>現在、メール通知機能を全ユーザー向けに解放中。無効にしたい場合は設定ページから変更してください。</p>

  <h4>今後の予定</h4>
  <ul class="uk-list uk-list-bullet">
    <li>必要な機能は大体作ったので後は要望次第。</li>
    <li>ウォッチリスト利用数が増えれば人気商品ランキングも作れるけど現状では意味がない。</li>
    <li>MWS APIも使いたいけど出品者アカウントがない。</li>
  </ul>

  <h4>追加済み</h4>
  <ul class="uk-list uk-list-bullet">
    <li>Amazonアカウントでログイン</li>
    <li>ウォッチリスト</li>
    <li>CSVでダウンロード</li>
    <li>価格履歴などのグラフ（スマホサイズを除く。）</li>
    <li>価格変動チェック（ホームに表示版）</li>
    <li>ASIN/JANリストのCSVをインポートしてウォッチリストに追加</li>
    <li>ウォッチリストの価格変動チェック（各ユーザーに通知。ウェブプッシュ通知。メール通知。）</li>
    <li>当たり前のようにhttps化も。</li>
  </ul>

  <h4>データ</h4>
  データベースが20GB近くまでのデータ量になってるので古いデータは削除している。

  <ul class="uk-list uk-list-bullet">
    <li>ASINカウント : {{ number_format($items_count) }}</li>
    <li>履歴カウント : {{ number_format($histories_count) }}</li>
    <li>カテゴリーカウント : {{ number_format($browses_count) }}</li>
    <li>ユーザーカウント : {{ number_format($user_count) }}</li>
  </ul>

  <h4>システム</h4>
  <ul class="uk-list uk-list-bullet">
    <li>AWS/RDS</li>
    <li>PHP {{ PHP_MAJOR_VERSION }}.{{ PHP_MINOR_VERSION }}/MySQL 5.7/Redis/memcached</li>
    <li>Laravel {{ app()->version() }}/Socialite/Horizon</li>
    <li>Vue.js/UIkit</li>
  </ul>
</div>
