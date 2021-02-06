<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <title></title>
    <link rel="icon" href="" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
    <style>
        .bg-light {
            background-color: #eae9e9 !important;
        }
    </style>
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>
@if (Auth::check())
    <script>
        window.Laravel = {!!json_encode([
               'isLoggedin' => Auth::guard()->check(),
               'token' => csrf_token(),
               'user' => Auth::user()
           ])!!}
    </script>
    <script>window.Laravel.csrfToken = {csrfToken: '{{ csrf_token() }}'}</script>
@else
    <script>
        window.Laravel = {!!json_encode([
                'isLoggedin' => Auth::guard()->check(),
                'token' => csrf_token()
            ])!!}
    </script>
@endif
<div id="app">
</div>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script> -->
</body>
</html>
