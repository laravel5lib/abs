@extends('layouts.master')

@section('title', 'プラン' . ' | ')


@section('content')

  <h2 class="uk-heading-divider">プラン</h2>

  <div class="uk-alert-warning" uk-alert>
    <p>ビジネスは終了しました。</p>
  </div>

  <table class="uk-table uk-table-striped uk-table-hover uk-table-divider">
    <caption></caption>
    <thead>
    <tr class="uk-text-nowrap">
      <th></th>
      <th><strong>フリー</strong></th>
      <th><strong>パーソナル</strong></th>
      <th><strong>
          <del>ビジネス</del>
        </strong></th>
      <th><strong>エンタープライズ</strong></th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <th><strong>料金（月額）</strong></th>
      <td>無料</td>
      <td>500円</td>
      <td></td>
      <td>10万円〜</td>
    </tr>

    <tr>
      <th><strong>ウォッチリスト上限</strong></th>
      <td>未定</td>
      <td>未定</td>
      <td>無制限</td>
      <td>無制限</td>
    </tr>

    <tr>
      <th><strong>ウォッチリストの変動チェックをメール通知</strong></th>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: check"></span></td>
      <td><span uk-icon="icon: check"></span></td>
      <td><span uk-icon="icon: check"></span></td>
    </tr>

    <tr>
      <th><strong>CSVダウンロード件数</strong></th>
      <td>100</td>
      <td>無制限</td>
      <td>無制限</td>
      <td>無制限</td>
    </tr>

    <tr>
      <th><strong>ASIN/JAN(EAN)リストのCSVインポート</strong></th>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: check"></span></td>
      <td><span uk-icon="icon: check"></span></td>
      <td><span uk-icon="icon: check"></span></td>
    </tr>

    <tr>
      <th><strong>エクスポート機能</strong><br>
        カテゴリーIDや件数を指定してのCSVダウンロード
      </th>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: check"></span></td>
      <td><span uk-icon="icon: check"></span></td>
      <td><span uk-icon="icon: check"></span></td>
    </tr>
    <!--
        <tr>
          <th><strong>API</strong></th>
          <td><span uk-icon="icon: close"></span></td>
          <td><span uk-icon="icon: close"></span></td>
          <td><span uk-icon="icon: check"></span></td>
          <td><span uk-icon="icon: check"></span></td>
        </tr>
    -->
    <tr>
      <th><strong>管理者権限</strong></th>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: check"></span></td>
    </tr>

    <tr>
      <th><strong>自社サーバーでの運営</strong><br>
        AWS(EC2+RDS)推奨。
      </th>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: check"></span></td>
    </tr>

    <tr>
      <th><strong>チャットワークでのサポート</strong></th>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: check"></span></td>
    </tr>

    <tr>
      <th><strong>支払い方法</strong></th>
      <td><span uk-icon="icon: close"></span></td>
      <td>pixivFANBOX</td>
      <td></td>
      <td>チャットワークで問い合わせ</td>
    </tr>

    <tr>
      <th><strong>解約方法</strong></th>
      <td><span uk-icon="icon: close"></span></td>
      <td></td>
      <td></td>
      <td>チャットワークで連絡</td>
    </tr>

    </tbody>
  </table>

  @include('pages.plan_pay')

  <div class="uk-section uk-section-primary uk-light uk-padding">
    <div class="uk-container">
      <h2>エンタープライズプラン</h2>

      <p>当サイトと全く同じサービスを自社サーバーで運営できます。</p>

      <h4>メリット</h4>
      <ul class="uk-list uk-list-bullet">
        <li>多少の独自機能追加。海外Amazonからの情報も取得など。</li>
        <li>機能スイッチで不要な機能をオン・オフ。</li>
        <li>RDSから直接データを参照できる。</li>
        <li>自社Amazonアカウントで運営することでAPIの使用制限を受けにくくなる。たまに取得できないのはAPIの制限。</li>
        <li>非公開モードとシングルユーザーモードで社内向け限定で運営。</li>
        <li>不要なカテゴリーのデータを削除して必要なデータのみ収集。</li>
      </ul>

      <h4>ASIN取得速度の目安</h4>
      <ul class="uk-list uk-list-bullet">
        <li>APIの制限が1秒に1回。一度にASIN10件。現実的には5-10秒ごとに1回が限度。</li>
        <li>ウォッチリストのASINだけを全力で取得する場合、1日9-18万件程度。</li>
      </ul>

      <h4>必要なこと</h4>
      <ul class="uk-list uk-list-bullet">
        <li>Amazon/AWS/API用のアカウント。海外の情報も取得するには各国のアカウントも。</li>
        <li>ドメイン。サブドメインでも可。</li>
        <li>ソースを提供して自分で設置する方式ではありません。EC2+RDSの管理はこちらに任せてもらいます。バージョンアップは当サイトと同時に行います。料金は継続的なバージョンアップ作業の分。</li>
        <li>連絡手段としてチャットワークが必須です。</li>
      </ul>

      <h4>開始までのもう少し詳しい流れ</h4>
      <ul class="uk-list uk-list-bullet">
        <li><a href="https://www.chatwork.com/kawax" class="uk-button uk-button-text" target="_blank">チャットワーク</a>で問い合わせ。コンタクトに追加してください。
        </li>
        <li>Amazonアカウントのログイン情報を教えてもらう。もしくは必要な作業ができる権限を持ったIAMユーザーの情報。もしくはEC2とRDSを用意してもらってログインに必要な情報だけもらう。</li>
        <li>EC2の設定はこちらで行います。WordPressが動く程度のサーバーでは機能が足りないのでこちらで設定しないと動きません。</li>
        <li>EC2はt2.micro以上、OSはUbuntu 18.04。すでに使ってるEC2の流用はできません。RDS(MySQL 5.7)なら流用できます。</li>

      </ul>

      <h4>解約時</h4>
      <ul class="uk-list uk-list-bullet">
        <li>バージョンアップができないまま使用するのは危険なのでサーバーのデータは削除します。</li>
      </ul>
    </div>
  </div>
@endsection
