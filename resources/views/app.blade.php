<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect dns-prefetch" href="{{ url()->current() }}">
    <link rel="preconnect" href="{{ config('app.asset_url') }}">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link rel="preconnect" href="//www.google-analytics.com">
    <link rel="preconnect" href="{{config('app.env') === 'local' ? '/fonts/bignoodletitling/stylesheet.css?v=1.0' : config('app.asset_url') . '/' . config('app.client_id') . '/build/assets/fonts/bignoodletitling/stylesheet.css?v=1.0'}}">

    <link
        href="{{config('app.env') === 'local' ? '/fonts/bignoodletitling/stylesheet.css?v=1.0' : config('app.asset_url') . '/' . config('app.client_id') . '/build/assets/fonts/bignoodletitling/stylesheet.css?v=1.0'}}"
        rel="stylesheet"/>

    <base href="{{ url('/') }}">

    @include('script.HeadScripts')

    @if (config('app.env') === 'local')
        @vite('resources/js/app.js')
    @else
        @php
            $manifest = json_decode(
                file_get_contents(
                    config('app.asset_url') . '/' . config('app.client_id') . '/build/manifest.json',
                ),
            );
        @endphp
        <script type="module"
                src="{{ config('app.asset_url') . '/' . config('app.client_id') . '/build/' . $manifest->{'resources/js/app.js'}->{'file'} }}">
        </script>
        <link rel="stylesheet"
              href="{{ config('app.asset_url') . '/' . config('app.client_id') . '/build/' . $manifest->{'resources/js/app.js'}->{'css'}[0] }}"/>
    @endif

    @include('script.RootStyles')

    <title inertia>{{ $meta['title'] ?? config('app.title') }}</title>

    <meta head-key="description" name="description"
          content="{{ $meta['description'] ?? $page['props']['siteConfig']['basic_configurations'][0]['meta_description'] }}"/>

    <meta head-key="keywords" name="keywords"
          content="{{ $meta['keywords'] ?? $page['props']['siteConfig']['basic_configurations'][0]['meta_keywords'] }}"/>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="shortcut icon" href="{{$page['props']['siteConfig']['basic_configurations'][0]['favicon_cdn']}}"/>

    <meta name="author" content="L8 Digital"/>
    <link rel="canonical" href="{{ url()->current() }}"/>
    <link rel="alternate" media="only screen and (max-width: 640px)" href="{{ url()->current() }}">

    <meta property="og:image"
          content="{{$page['props']['siteConfig']['basic_configurations'][0]['meta_image_cdn']}}"/>
    <meta property="og:image:secure_url"
          content="{{$page['props']['siteConfig']['basic_configurations'][0]['meta_image_cdn']}}"/>
    <meta property="og:image:type" content="image/webp"/>
    <meta property="og:image:width" content="{{ config('app.width') }}"/>
    <meta property="og:image:height" content="{{ config('app.height') }}"/>

    <meta name="og:title" property="og:title" content="{{ $meta['title'] ?? config('app.title') }}"/>
    <meta name="og:description" property="og:description"
          content="{{ $meta['description'] ?? $page['props']['siteConfig']['basic_configurations'][0]['meta_description'] }}"/>
    <meta name="og:url" property="og:url" content="{{ url()->current() }}"/>
    <meta name="og:width" property="og:width" content="{{ config('app.width') }}"/>
    <meta name="og:height" property="og:height" content="{{ config('app.height') }}"/>
    <meta name="og:locale" property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>

    <meta name="twitter:title" property="twitter:title" content="{{ $meta['title'] ?? config('app.title') }}"/>
    <meta name="twitter:description" property="twitter:description"
          content="{{ $meta['description'] ?? $page['props']['siteConfig']['basic_configurations'][0]['meta_description'] }}"/>
    <meta name="twitter:image" property="twitter:image"
          content="{{$page['props']['siteConfig']['basic_configurations'][0]['meta_image_cdn']}}"/>
    <meta name="twitter:image:src" property="twitter:image:src"
          content="{{$page['props']['siteConfig']['basic_configurations'][0]['meta_image_cdn']}}"/>
    <meta name="twitter:card" property="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" property="twitter:site" content="L8 Digital"/>
    <meta name="twitter:creator" property="twitter:creator" content="@l8digital"/>
    <meta name="twitter:url" property="twitter:url" content="{{ url()->full() }}"/>

    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="_key" content="{{ config('services.recaptcha.key') }}">

    @routes
    @inertiaHead

</head>

<body class="font-sans bg-black">
@inertia

@include('script.BodyScripts')
</body>

</html>
