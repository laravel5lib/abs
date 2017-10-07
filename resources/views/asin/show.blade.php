@extends('layouts.master')

@empty($alert_message)

  @php
    $title = array_get($item, 'ItemAttributes.Title');
  @endphp

  @section('title', $title . ' | ')
@endempty

@section('content')

  @empty($alert_message)
    @include('item.watchlist')

    <h1 class="uk-heading-divider uk-heading-primary">{{ $title }}</h1>

    @include('asin.item')

    @else
      <div class="uk-alert-danger" uk-alert>
        <p>見つかりませんでした。しばらく待ってからリロードするか他の商品を検索してください。</p>
      </div>
      @endempty

@endsection
