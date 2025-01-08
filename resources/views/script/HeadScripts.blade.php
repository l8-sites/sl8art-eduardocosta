@if(\Illuminate\Support\Facades\Route::currentRouteNamed('home'))
    <link rel="preload" fetchpriority="high" as="image"
          href="{{ $page['props']['siteConfig']['basic_configurations'] ? $page['props']['siteConfig']['basic_configurations'][0]['logo_cdn'] : '' }}"
          type="image/svg+xml">
@endif

@if(\Illuminate\Support\Facades\Route::currentRouteNamed('noticia'))
    <link rel="preload" as="image" href="{{ $page['props']['news'] ? $page['props']['news']['image'] : '' }}" type="image/webp" fetchpriority="high">
@endif

<script type="application/ld+json">
    {
       "@type":"WebSite",
       "@context":"https://schema.org",
       "name":"{{config('app.title')}}",
       "description":"{{ $page['props']['siteConfig']['basic_configurations'] ? $page['props']['siteConfig']['basic_configurations'][0]['meta_description'] : ''}}",
       "url":"{{url()->current()}}",
       "logo":"{{ $page['props']['siteConfig']['basic_configurations'] ? $page['props']['siteConfig']['basic_configurations'][0]['logo'] : ''}}",
       "sameAs": [
        "{{$page['props']['siteConfig']['basic_configurations'] ? $page['props']['siteConfig']['basic_configurations'][0]['instagram'] : ''}}"
      ]
  }
</script>

@if(\Illuminate\Support\Facades\Route::currentRouteNamed('agenda'))
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "MusicEvent",
        "name": "{{ $page['props']['schedule']['name'] }}",
        "startDate": "{{ $page['props']['schedule']['date'] }} T{{ $page['props']['schedule']['time'] }}",
        "location": {
            "@type": "Place",
            "name": "{{ $page['props']['schedule']['local'] }}",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "{{ $page['props']['schedule']['city_name'] }}",
                "addressRegion": "{{ $page['props']['schedule']['state_uf'] }}",
                "addressCountry": "{{ $page['props']['schedule']['country_name'] }}"
            }
        },
        "image": ["{{ $page['props']['siteConfig']['basic_configurations'][0]['meta_image'] }}"],
        "description": "{{ $page['props']['schedule']['city_name'] }} - {{$page['props']['schedule']['state_uf'] }} contará com a presença de {{ $page['props']['siteConfig']['name'] }} dia {{ strtolower(data_completa($page['props']['schedule']['date'], 11)) }}!",
         "offers": {
                "@type": "Offer",
                "url": "{{$page['props']['schedule']['link_sale']}}",
                "availability": "https://schema.org/InStock"
            },
            "organizer": {
                "@type": "Organization",
                "name": "{{config('app.title')}}",
                "url": "{{url('/agenda')}}"
            }
    }
    </script>
@endif

@if(\Illuminate\Support\Facades\Route::currentRouteNamed('noticia'))
    <script type="application/ld+json">
    {
        "@type": "NewsArticle",
        "@context": "https://schema.org",
        "headline": "{{ preg_replace('/["`“”]/i', '', $page['props']['news']['title']) }}",
        "image": [
            "{{$page['props']['news']['image']}}"
        ],
        "datePublished": "{{$page['props']['news']['created_at']}}",
        "dateModified": "{{$page['props']['news']['updated_at']}}",
        "author": [{
            "@type": "Person",
            "name": "{{ $page['props']['news']['author'] ?? config('app.client') }}",
            "url": "{{url('')}}"
        }],
        "publisher": [{
          "name": "{{config('app.client')}}"
        }]
    }
    </script>
@endif
