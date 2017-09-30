<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  @include('layouts.analytics')

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title'){{ config('app.name') }}</title>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  <meta name="google-site-verification" content="ze9To10Rt1BJ8MHvCYckSYUX63LQTID3bibf7gEbPkw">
</head>
<body>

@include('layouts.header')

<main class="uk-container">

  @include('home.form')

  @yield('content')


</main>

@include('layouts.footer')


<script src="{{ mix('/js/app.js') }}" async></script>

<!-- {{ app()->version() }} -->

</body>
</html>
