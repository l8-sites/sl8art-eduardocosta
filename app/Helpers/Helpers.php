<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
if(!function_exists('get_token')){
    function get_token(){

        $token = Session::get('token');
        if(!empty($token)) return $token;

        $data = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
            'Authorization' => 'Bearer '.config('constants.AUTH_TOKEN')
        ])->get(env('API_ENDPOINT_AUTH'));
        $json = json_encode($data->object());
        $array = json_decode($json, true);
        if(array_key_exists('token', $array)){
            Session::put('token', $array['token']);
            return $array['token'];
        }
        return false;
    }
}

if(!function_exists('artists_api_get')){
    function artists_api_get($get) {
        $token = get_token();

        if($token){
            $data = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ])->get(env('API_ENDPOINT') . $get);
            $json = json_encode($data->object());
            return json_decode($json, true);
        }
        return [];
    }
}

if (!function_exists('luminosity')) {
    function luminosity($hex)
    {
        if (!empty($hex)) {
            $hex = str_replace('#', '', $hex);

            $longo = strlen($hex) > 3;
            //            dd($longo);

            $r = $longo ? intval(substr($hex, 0, 2), 16) : intval(substr($hex, 0, 1), 16) * 17;
            $g = $longo ? intval(substr($hex, 2, 2), 16) : intval(substr($hex, 1, 1), 16) * 17;
            $b = $longo ? intval(substr($hex, 4, 2), 16) : intval(substr($hex, 2, 1), 16) * 17;

            $value = ($r * 299 + $g * 587 + $b * 114) / 1000;

            return $value > 128 ? '#000' : '#fff';
        }

        return 0;
    }
}

if (!function_exists('shadeColor')) {
    function shadeColor($color, $percent)
    {
        if ($color) {
            $hexa = str_replace('#', '', $color);
            $leng = strlen($color) > 3;

            $r = $leng ? intval(substr($hexa, 0, 2), 16) : intval(substr($hexa, 0, 1), 16) * 17;
            $g = $leng ? intval(substr($hexa, 2, 2), 16) : intval(substr($hexa, 1, 1), 16) * 17;
            $b = $leng ? intval(substr($hexa, 4, 2), 16) : intval(substr($hexa, 2, 1), 16) * 17;

            $r = intval(($r == 0 ? 30 : $r) * ((100 + $percent) / 100));
            $g = intval(($g == 0 ? 30 : $g) * ((100 + $percent) / 100));
            $b = intval(($b == 0 ? 30 : $b) * ((100 + $percent) / 100));

            $r = ($r < 255) ? $r : 255;
            $g = ($g < 255) ? $g : 255;
            $b = ($b < 255) ? $b : 255;

            return 'rgb(' . $r . ',' . $g . ',' . $b . ')';
        }
    }
}

if (!function_exists('formatadata')) {

    function formatadata($date)
    {

        return Carbon::parse($date)->format('d/m/Y');

    }

}
if (!function_exists('data_completa')) {

    /**
     * @data: recebe data em timestamp
     * @tipo_mes: completo ou abreviado
     * @tipo_ano: 2 ou 4 digitos
     * @retorno:
     *          1 - ex.: 16 DE ABRIL DE 2018
     *          2 - ex.: 16/04/2018
     *          3 - ex.: 2018-04-16
     *          4 - ex.: 16 ABR 2018
     *          5 - ex.: 01
     *          6 - ex.: ABR ou ABRIL
     *          7 - ex.: 18 ou 2018
     *          8 - ex.: SEG ou SEGUNDA
     *          9 - ex.: 16/04
     *          10 - ex.: 02 (mês)
     */
    function data_completa($data, $retorno, $tipo_mes = "", $tipo_dia = "") {


//        dd($data);

//        $date = formatadata($data);

        $arr = explode('/', formatadata($data));
        $data = $arr[0];

//        dd($arr);
//        $data = formatadata($data);

        $mes_nome_completo = array('', 'JANEIRO', 'FEVEREIRO', 'MARÇO', 'ABRIL', 'MAIO', 'JUNHO', 'JULHO', 'AGOSTO', 'SETEMBRO', 'OUTUBRO', 'NOVEMBRO', 'DEZEMBRO');
        $mes_nome_abreviado = array('', 'JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ');

        $dia_semana_completo = array('DOMINGO', 'SEGUNDA', 'TERÇA', 'QUARTA', 'QUINTA', 'SEXTA', 'SÁBADO');
        $dia_semana_abreviado = array('DOM', 'SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SÁB');

        $data_usa = $arr;

//        dd($data_usa[2]);

        $mes_numero = intval($arr[1]);
//                dd($mes_nome_abreviado[$mes_numero]);

        $mes = !empty($tipo_mes) ? $mes_nome_abreviado[$mes_numero] : $mes_nome_completo[$mes_numero];

        switch ($retorno){
            case 1:
                if(empty($tipo_mes)){
                    $mes = $mes_nome_completo[$mes_numero];
                }

                return $data_usa[2] . " DE " . $mes . " DE " . $data_usa[0];
                break;

            case 2:
                return $data_usa[2] . "/" . $data_usa[1] . "/" . $data_usa[0];
                break;

            case 3:
                return $data_usa[0] . "-" . $data_usa[1] . "-" . $data_usa[2];
                break;

            case 4:
                if(empty($tipo_mes)){
                    $mes = $mes_nome_completo[$mes_numero];
                }

                return $data_usa[2] . " " . $mes . " " . $data_usa[0];
                break;

            case 5:
                return $data_usa[2];
                break;

            case 6:
                return $mes;
                break;

            case 7:
                return $data_usa[0];
                break;

            case 8:

                $dia_semana = date('w', strtotime($data));
                return $tipo_dia == 1 ? $dia_semana_abreviado[$dia_semana] : $dia_semana_completo[$dia_semana];
                break;

            case 9:
                return $data_usa[2] . "/" . $data_usa[1];
                break;

            case 10:
                return $data_usa[1];
                break;

            case 11:
                return $data_usa[0] . " DE " . $mes;
                break;

            default:
                if(empty($tipo_mes)){
                    $mes = $mes_nome_completo[$mes_numero];
                }

                return $data_usa[0] . " DE " . $mes . " DE " . $data_usa[2];
                break;
        }

    }
}
