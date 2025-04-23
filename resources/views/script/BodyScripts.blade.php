

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

<!-- <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.key') }}"></script>
<script type="text/javascript">
    window.Laravel = {
        csrfToken: "{{ csrf_token() }}",
        recaptcha_key: "{{ config('services.recaptcha.key') }}"
    }
</script> -->


