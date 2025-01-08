<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml"
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
    xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
    <url>
        <loc>{{ $url }}</loc>
        <lastmod>2024-04-16T12:24:25.240Z</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    @if($menu_schedule)
        <url>
            <loc>{{ $url }}agenda</loc>
            <lastmod>2024-04-16T12:24:25.240Z</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>

        @foreach ($calendar as $each)
            <url>
                <loc>{{ $url }}agenda/{{ $each['url'] }}</loc>
                <lastmod>{{ $each['updated_at'] }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.9</priority>
            </url>
        @endforeach
    @endif

    @if($menu_news)
        <url>
            <loc>{{ $url }}noticia</loc>
            <lastmod>2024-04-16T12:24:25.240Z</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>

        @foreach ($news as $each)
            <url>
                <loc>{{ $url }}noticia/{{ $each['url'] }}</loc>
                <lastmod>{{ $each['updated_at'] }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.9</priority>
            </url>
        @endforeach
    @endif
</urlset>
