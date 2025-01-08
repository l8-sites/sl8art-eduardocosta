<?php
namespace App\Libraries;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Libraries\ArtistsApi;
use Carbon\Carbon;

class Spotify
{
    private $confg;
    private $token_spotify;
    public function __construct()
    {
        $this->config = (new ArtistsApi)->get('site_informations');
        $this->token_spotify = $this->config['configurations'][0]['spotifyid'];
    }

    public function album_single($type = 'single', $limit = 15, $offset = 0)
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
        ];
        if($type == 'top_tracks'){
            $end_point = config('app.spotify_top_tracks').$this->token_spotify;
            $response = Http::withHeaders($headers)->get($end_point);
        } else {
            $response = Http::withHeaders($headers)->post(config('app.spotify_single'), [
                'id_art' => $this->token_spotify,
                'type' => $type == 'single' || $type == 'album' ? $type : null,
                'limit' => $limit,
                'offset' => $offset
            ]);
        }

        $statusCode = $response->status();
//         dd($response->json());
        if($statusCode === 200 || $statusCode === 201) {
            $responseBody = $response->json();
            return $responseBody;
        }
        return false;
    }

    public function album_single_filter( $limit = 15)
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
        ];

        $response = Http::withHeaders($headers)->get(config('app.spotify_single_filter').$this->token_spotify.'/'.$limit);

        $statusCode = $response->status();
        // dd($response->json());
        if($statusCode === 200 || $statusCode === 201) {
            $responseBody = $response->json();
            return $responseBody;
        }
        return false;
    }

    public function albuns($limit = 15)
    {
        if($limit > 15) $limit = 15;

        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json'
        ];

        $end_point = config('app.spotify_albuns').$this->token_spotify.'/'.$limit;
        $response = Http::withHeaders($headers)->get($end_point);
        $statusCode = $response->status();
        if($statusCode === 200 || $statusCode === 201) {
            $responseBody = $response->json();
            return $responseBody['body'];
        }
        return false;
    }

    public function followers()
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json'
        ];

        $end_point = config('app.spotify_followers').$this->token_spotify;
        $response = Http::withHeaders($headers)->get($end_point);
        $statusCode = $response->status();
        if($statusCode === 200 || $statusCode === 201) {
            // dd($statusCode);
            $responseBody = $response->json();
            return $responseBody;
        }
        return false;
    }

    public function top_tracks()
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json'
        ];

        $end_point = config('app.spotify_top_tracks').$this->token_spotify;
        $response = Http::withHeaders($headers)->get($end_point);
        $statusCode = $response->status();
        if($statusCode === 200 || $statusCode === 201) {
            // dd($statusCode);
            $responseBody = $response->json();
            return $responseBody;
        }
        return false;
    }
}
