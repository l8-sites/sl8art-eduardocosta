<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\News;
use App\Libraries\ArtistsApi;
use Illuminate\Support\Str;

class SitemapController extends HomeController
{
    public function sitemap(){

        $calendar = (new ArtistsApi)->get('calendar_site_map');
        $news = (new ArtistsApi)->get('news');
        $url = config('app.url') . '/';
        $schedule = config('app.url') . '/';

        $config = (new ArtistsApi)->get('site_informations');
        $menu_news = array_search('noticia', $config['menus']);
        $menu_schedule = array_search('agenda', $config['menus']);

        return response()->view('sitemap.sitemap', compact('schedule', 'url', 'calendar', 'news', 'menu_news', 'menu_schedule'))->header('Content-Type', 'text/xml');
    }
}
