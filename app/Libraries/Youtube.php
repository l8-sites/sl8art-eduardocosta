<?php
namespace App\Libraries;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Libraries\ArtistsApi;
use Carbon\Carbon;

class Youtube
{
    private $confg;
    private $token_youtube_playlist;
    private $token_youtube_chanel;
    public function __construct()
    {
        $this->config = (new ArtistsApi)->get('site_informations');
        // dd($this->config);
        $this->token_youtube_playlist = $this->config['configurations'][0]['youtubeidplaylist'];
        $this->token_youtube_chanel = $this->config['configurations'][0]['youtubeidcanal'];
        // dd($this->token_youtube_chanel);
    }

    public function info()
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json'
        ];
        $end_point = config('app.youtube_info').$this->token_youtube_chanel;
        $response = Http::withHeaders($headers)->get($end_point);
        $statusCode = $response->status();
        if($statusCode === 200 || $statusCode === 201) {
            $responseBody = $response->json();
            return $responseBody;
        }
        return false;
    }

    public function playlist($limit = 15)
    {
        if($limit > 15) $limit = 15;

        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json'
        ];
        $end_point = config('app.youtube_playlist_limit').$this->token_youtube_playlist.'/'.$limit;
        $response = Http::withHeaders($headers)->get($end_point);
        $statusCode = $response->status();
        if($statusCode === 200 || $statusCode === 201) {
            $responseBody = $response->json();
            return $responseBody;
        }
        return false;
    }
}
