<?php
namespace App\Libraries;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ArtistsApi
{
    // public function __construct(public bool $token2 = false)
    // {

    // }

    public function get($path, $params = '', ...$params2)
    {
        $token = $this->get_token();

        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
            'Authorization' => 'Bearer '. $token
        ];
        if(!empty($params)){
            if(is_array($params)){
                $params = join(',', $params);
            }
            $end_point = config('app.endpoint') . $path . '/' . $params;
        } else $end_point = config('app.endpoint') . $path;

        if(!empty($params2)){
            $params2 = implode('/', $params2);
            $end_point = $end_point . '/' . $params2;
        }

        $response = Http::withHeaders($headers)->get($end_point);
        $statusCode = $response->status();
        if($statusCode === 200 || $statusCode === 201) {
            $responseBody = $response->json();
            return $responseBody;
        }
        return false;
    }

    public function post($path, $params)
    {
        $token = $this->get_token();
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
            'Authorization' => 'Bearer '. $token
        ];
        $response = Http::withHeaders($headers)->post(config('app.endpoint').$path, $params);
        $statusCode = $response->status();
        if($statusCode === 200 || $statusCode === 201) {
            $responseBody = $response->json();
            return $responseBody;
        }
        return false;
    }

    private function get_token()
    {
        $token = Session::get('token');
        $token_body = Session::get('token_body');


        if(!empty($token) && !empty($token_body['expires_at']) && Carbon::parse($token_body['expires_at'])->isFuture()) return $token;

        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
            'Authorization' => 'Bearer '.config('constants.AUTH_TOKEN')
        ];

        $response = Http::withHeaders($headers)->get(config('app.endpoint_auth'));
        $statusCode = $response->status();
        if($statusCode === 200 || $statusCode === 201){
            $responseBody = $response->json();
            Session::put('token_body', $responseBody['token']);
            Session::put('token', $responseBody['token']['token']);
            return $responseBody['token']['token'];
        }
        return false;
    }
}
