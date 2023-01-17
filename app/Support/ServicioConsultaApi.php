<?php
namespace App\Support;
use Illuminate\Support\Facades\Http;

trait ServicioConsultaApi {


    /**
     * Autor Fredy Yela
     * Función para realizar una consulta a un servicio que devuelve usuarios y transacciones
     * @param  String | null
     * @return Array | String 
     */
    private function get_api($param = '/'){

        $url = config('holding.api_users'); //url de la api
        $token = config('holding.api_users_token'); // Token de la api
        $new_url = "";

        //Validar que la variable url y token contengan información Ya que estas varibles se asigna un valor en el .env y por defecto son null
        if(!is_null($url) && !is_null($token)){

            $new_url = $url.'users/'.$token.$param;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $new_url); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200); 
            curl_setopt($ch, CURLOPT_TIMEOUT, 200); 
            curl_setopt($ch, CURLOPT_HEADER, 0); 

            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
            $data = curl_exec($ch); 

            if(curl_errno($ch)){

                $response = [
                    'code' => 403,
                    'status' => false,
                    'message' => 'Error al realizar petición a la api de usuarios'
                ];
                return $response;
            }

            curl_close($ch); 
           
            $response = [
                'code' => 200,
                'status' => true,
                'message' => 'Usuarios consultados con exito',
                'data' => json_decode($data)
            ];
            return $response;
        }

        $response = [
            'code' => 404,
            'status' => false,
            'message' => 'Error al internar realizar la consulta url y token no existen'
        ];
        return $response;
       
    }


    public function consulta($param = '/'){

        $url = config('holding.api_users'); //url de la api
        $token = config('holding.api_users_token'); // Token de la api
        $new_url = "";

        if(!is_null($url) && !is_null($token)){

            $new_url = $url.'users/'.$token.$param;
            $request = Http::get($new_url);

            if($request->successful()){
                $response = [
                    'code' => 200,
                    'status' => true,
                    'message' => 'Usuarios consultados con exito',
                    'data' => $request->object()
                ];
                return (object) $response;
            } 

            $response = [
                'code' => 400,
                'status' => false,
                'message' => 'Error al realizar petición a la api de usuarios'
            ];
            return (object) $response;

        } else {
            $response = [
                'code' => 404,
                'status' => false,
                'message' => 'Error al internar realizar la consulta url y token no existen'
            ];
            return (object) $response;
        }
    }

    

    


}