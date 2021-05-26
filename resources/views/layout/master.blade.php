<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <title>Pricer</title>
</head>
<body class="antialiased min-h-screen w-screen bg-gray-100">

@include('layout._header')

<div class="container mx-auto py-12">
  @yield('content')
</div>

</body>
</html>
