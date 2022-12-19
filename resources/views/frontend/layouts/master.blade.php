<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portfolio</title>
    <meta name="keywords" content="resume,portfolio,php,laravel">
    <meta name="description" content="Best software engineer">
    <link rel="canonical" href="{{url()->current()}}"/>
    <meta name="description" content="">
    <meta name="author" content="Abdullah Al Mamun">

    @include('frontend.layouts.partials.styles')
</head>
<body>

@yield('content')

@include('frontend.layouts.partials.scripts')
</body>
</html>
