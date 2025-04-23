@if(\Illuminate\Support\Facades\Route::currentRouteNamed('home'))
<link rel="preload" as="image" href="{{ $page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['bgdesk_home'] : '' }}" type="image/webp" fetchpriority="high">
<link rel="preload" as="image" href="{{ $page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['bgmobile_home'] : '' }}" type="image/webp" media="(max-width: 768px)" fetchpriority="high">
<link rel="preload" fetchpriority="high" as="image" href="{{ $page['props']['siteConfig']['basic_configurations'] ? $page['props']['siteConfig']['basic_configurations'][0]['logo_cdn'] : '' }}" type="image/svg+xml">
@endif

@if(\Illuminate\Support\Facades\Route::currentRouteNamed('noticia'))
<link rel="preload" as="image" href="{{ $page['props']['news']['image'] }}" type="image/webp" fetchpriority="high">
<link rel="preload" as="image" href="{{ $page['props']['news']['image'] }}" type="image/webp" media="(max-width: 768px)" fetchpriority="high">
@endif

<script type="application/ld+json">
    {
       "@type":"WebSite",
       "@context":"https://schema.org",
       "name":"{{$page['props']['siteConfig']['basic_configurations'][0]['meta_title']}}",
        "alternateName": "Wagner Tintas",
       "description":"{{$page['props']['siteConfig']['basic_configurations'][0]['meta_description']}}",
       "url":"{{url()->current()}}",
       "logo":"{{$page['props']['siteConfig']['basic_configurations'][0]['logo']}}",
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "{{url('')}}/buscar?q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
  }
</script>

@if(\Illuminate\Support\Facades\Route::currentRouteNamed('produto'))

<script type="application/ld+json">
    {
        "@context": "https://schema.org/",


        "@type": "Product",


        "name": "{{preg_replace('/["`“”]/i', '', $page['props']['product']['name'])}}",
        "description": "Obs: Consultar a disponibilidade do produto em estoque com nossos atendentes.",


        "image": "{{$page['props']['product']['image_cdn']}}",


        "sku": "{{$page['props']['product']['id']}}",


        "offers": {
            "@type": "Offer",
            "priceCurrency": "BRL",
            "price": "{{number_format($page['props']['product']['price'] / 100, 2, '.', '')}}",
            "itemCondition": "https://schema.org/NewCondition",
            "availability": "https://schema.org/InStock",
            "url": "{{ $_SERVER['HTTP_HOST'] . $page['url'] }}"
        },


        "category": "Tintas",


        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.5",
            "ratingCount": "100"
        }


    }
</script>
@endif
