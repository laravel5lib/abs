@extends('layouts.master')

@section('title', '通知 | ')

@section('content')


  <h1 class="uk-heading-divider">通知</h1>

  <web-push></web-push>

  <a href="{{ route('push.test') }}" class="uk-button uk-button-default uk-button-small uk-margin-top">
    ウェブプッシュ通知テスト
  </a>

  <div class="uk-alert-primary" uk-alert>
    <p>CSVダウンロードは一度のみ有効です。</p>
  </div>

  {{ $notifications->links() }}

  <div class="uk-overflow-auto">

    <table class="uk-table uk-table-striped uk-table-hover uk-table-divider uk-table-small">
      <thead>
      <tr class="uk-text-nowrap">
        <th>日時</th>
        <th>メッセージ</th>
      </tr>
      </thead>
      <tbody>
      @foreach($notifications as $notification)
        <tr>
          @switch($notification->type)
            @case(App\Notifications\CsvExported::class)
            @include('notification.type.csv')
            @break

            @case(App\Notifications\WatchPriceAlertNotification::class)
            @include('notification.type.price')
            @break

            @default
            <td>{{ $notification->created_at }}</td>
            <td>
              {{ array_get($notification->data, 'message') }}
            </td>
          @endswitch

        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

  {{ $notifications->links() }}

@endsection
