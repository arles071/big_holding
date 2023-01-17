<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Support\ServicioConsultaApi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ServicioConsultaApi;

    /**
     * Autor Fredy Yela
     * Función para obtener todos los registros de usuarios
     */
    public function get_users(){
        $result = (object) $this->get_api();
        $data = null;

        if(!$result->status){
            $response = [
                'code' => 400,
                'success' => false,
                'message' => 'Error al realizar la consulta',
                'message_api' => $result->message
            ];
        }

        
        $users = $result->data;

        foreach($users as $user){
            $data[] = [
                'id' => $user->id,
                'identification_type_id' => ($user->identification_type_id === 1) ? 'CC': 'TI',
                'identification_number' => $user->identification_number,
                'mobile_number' => $user->mobile_number,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'accion' => '<a href="/transacciones/'.$user->id.'">transacciones</a>'
            ];
            
        }

        usort($data, function ($a, $b) {
            return strcmp($b["created_at"], $a["created_at"]);
        });

        $response = [
            'code' => 200,
            'success' => true,
            'message' => 'Usuarios consultados con exito',
            'data'    => $data,
        ];
        
        return response()->json($response, $response['code']);
               
    }

    /**
     * Autor Fredy Yela
     * Función para obtener todos los registros de usuarios
     */
    public function get_users_id($id){
        $result = (object) $this->get_api();
        $data = null;

        if(!$result->status){
            $response = [
                'code' => 400,
                'success' => false,
                'message' => 'Error al realizar la consulta',
                'message_api' => $result->message
            ];
        }

        
        $users = collect($result->data);
        $data = $users->where('id', $id);

        $response = [
            'code' => 200,
            'success' => true,
            'message' => 'Usuarios consultados con exito',
            'data'    => $data,
        ];
        
        return response()->json($response, $response['code']);
               
    }

    /**
     * Autor Fredy Yela
     * Función para obtener todas las trasaciones de un usuario
     */
    public function get_transacciones($id){
        $result = (object) $this->get_api('/transaction/'.$id);
        $data = null;   
        
        if(!$result->status){
            $response = [
                'code' => 400,
                'success' => false,
                'message' => 'Error al realizar la consulta de trasnaciones',
                'message_api' => $result->message
            ];
        }

        $transacciones = $result->data;
        //Valido si contiene transacciones
        if(empty($transacciones)){

            $response = [
                'code' => 404,
                'success' => false,
                'message' => 'El Usuario no tiene trasaciones',
            ];

        } else {

            foreach($transacciones as $transacion){
                $data[] = [
                    'id' => $transacion->id,
                    'transaction_status_id' => $transacion->transaction_status_id,
                    'transaction_currency_id' => $transacion->transaction_currency_id,
                    'year' => $transacion->year,
                    'amount' => $transacion->amount,
                    'created_at' => $transacion->created_at,
                    'updated_at' => $transacion->updated_at,
                    
                ];
                
            }

            //Ordena la fecha de mayor a menor
            usort($data, function ($a, $b) {
                return strcmp($b["created_at"], $a["created_at"]);
            });

            $response = [
                'code' => 200,
                'success' => true,
                'message' => 'transacciones de usuarios consultados con exito',
                'data'    => $data,
            ];
        }
        
        return response()->json($response, $response['code']);
               
    }

}
