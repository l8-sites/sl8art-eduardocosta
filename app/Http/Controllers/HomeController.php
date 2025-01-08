<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Libraries\Spotify;
use App\Libraries\Youtube;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Libraries\ArtistsApi;
use Closure;
use Illuminate\Support\Facades\Http;
use Throwable;

class HomeController extends BaseController
{
    public function index(){
    //    dd((new Youtube)->playlist());

        $return['meta'] = [
            'title'       =>  config('app.title'),
        ];

        return Inertia::render('Home/Home')->withViewData('meta', $return['meta']);
    }

    public function schedule(){
        $schedules =  (new ArtistsApi)->get('calendar_month');

        if($schedules) {
            $return['meta'] = [
                'title'       => 'Agenda | ' . config('app.title'),
                'description' => 'Fique por dentro da agenda de ' . config('app.title'),
            ];

            $return['schedules'] = $schedules;

            return Inertia::render('Schedule/Index/Schedule', $return)->withViewData('meta', $return['meta']);
        } else {
            abort(404);
        }
    }

    public function scheduleDetails($url){

        $schedule =  (new ArtistsApi)->get('calendar_url', $url);

        if($schedule) {
            $return['meta'] = [
                'title'       => strtolower(data_completa($schedule['detail']['date'], 11)) . ' - ' . $schedule['detail']['city_name'] . ' ' . $schedule['detail']['state_uf'] . ' | ' . config('app.title'),
                'description' => $schedule['detail']['city_name'] . ' ' . $schedule['detail']['state_uf'] . ' contará com a presença de ' . config('app.title') . ' dia ' . strtolower(data_completa($schedule['detail']['date'], 11))  . '.',
            ];

            $return['schedule'] = $schedule['detail'];
            $return['next_schedule'] = $schedule['data'];

        
            return Inertia::render('Schedule/Details/ScheduleDetails', $return)->withViewData('meta', $return['meta']);
        } else {
            abort(404);
        }
    }

    public function news()
    {
        $news =  (new ArtistsApi)->get('news');
        $emphasis = (new ArtistsApi)->get('new_emphasis');

        $data = array_merge($news, $emphasis);

        if ($data) {
            $return['meta'] = [
                'title'       => 'Notícias | ' . config('app.title'),
                'description' => 'Fique por dentro com as noticias exclusivas de ' . config('app.title'),
            ];

            $return['data'] = $data;

            $return['emphasis'] =  (new ArtistsApi)->get('new_emphasis');

            //            dd($return['emphasis']);

            return Inertia::render('News/Index/News', $return)->withViewData('meta', $return['meta']);
        } else {
            abort(404);
        }
    }

    public function newsDetails($url)
    {
        $news =  (new ArtistsApi)->get('new_url', $url);

        if ($news) {
            $return['meta'] = [
                'title'       => $news['title'] . ' | ' . config('app.title'),
                'description' => $news['subtitle'],
            ];

            if ($news['tags']) {
                $news['tags'] = explode(',', $news['tags']);
            } else {
                $news['tags'] = [];
            }

            $return['newsTags'] =  (new ArtistsApi)->get('new_tag', $news['tags'], $news['id']);
            $return['news'] = $news;

            //            dd($news);
            //            dd($return['newsTags']);
            return Inertia::render('News/Details/NewsDetails', $return)->withViewData('meta', $return['meta']);
        } else {
            abort(404);
        }
    }

    public function privacy()
    {
        $return['meta'] = [
            'title'       => 'Política de Privacidade | ' . config('app.title'),
            'description' => 'Confira como armazenamos e protegemos os seus dados pessoais.',
        ];

        return Inertia::render('Privacy/Privacy', $return)->withViewData('meta', $return['meta']);
    }

    public function artists_api(Request $request)
    {
        $validatedData = $request->validate([
            'path' => 'required|string',
            'method' => 'required|string',
            'data' => 'nullable',
            'data.token' => ['nullable', function (string $attribute, mixed $value, Closure $fail) use ($request) {
                if (!empty($value)) {
                    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                        'secret' => config('services.recaptcha.secret'),
                        'response' => $value,
                        'remoteip' => $request->ip()
                    ]);

                    if (!$response->json('success')) {
                        $fail('Tente novamente');
                    }
                }
            }]
        ]);

        try {
            $method = strtolower($validatedData['method']);
            $path = $validatedData['path'];
            $data = $validatedData['data'] ?? [];

            $response = match ($method) {
                'get' => (new ArtistsApi)->get($path, $data),
                'post' => (new ArtistsApi)->post($path, $data),
                default => response()->json(['error' => "Método não suportado", 405])
            };

            return response()->json($response);
        } catch (Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 400]);
        }
    }

    public function spotify(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
            'data' => 'nullable'
        ]);

        try {
            switch($request->path){
                case "albuns":
                    $response = (new Spotify)->albuns($request->data);
                    break;
                case "followers":
                    $response = (new Spotify)->followers();
                    break;
                case "album_single":
                    $response = (new Spotify)->album_single($request->data['type'], $request->data['limit']);
                    break;
                case "album_single_filter":
                    $response = (new Spotify)->album_single_filter( $request->data['limit']);
                    break;
                default:
                    return response()->json(['error' => "Método não suportado", 405]);
            }
            return response()->json($response);
        } catch (Throwable $th) {
            return response()->json(['error'=>$th->getMessage(), 400]);
        }
    }

    public function youtube(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
            'data' => 'nullable'
        ]);

        try {
            switch($request->path){
                case "info":
                    $response = (new Youtube)->info();
                    break;
                case "playlist":
                    $response = (new Youtube)->playlist($request->data);
                    break;
                default:
                    return response()->json(['error' => "Método não suportado", 405]);
            }
            return response()->json($response);
        } catch (Throwable $th) {
            return response()->json(['error'=>$th->getMessage(), 400]);
        }
    }
}
