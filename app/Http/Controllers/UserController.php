<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ServicioConsultaApi;

class UserController extends Controller
{
    use ServicioConsultaApi;


    /**
     * Autorn Fredy Yela
     * Lista todos los usuarios
     */
    public function index(){
        return view('users');
    }

   

    public function get_transacciones($id){
        //$url_table = '/transacciones/'.$id.'/table';
        $url_table = '/api/usuarios/transacciones/'.$id;
        //$users = $this->get_api();
        $status_trasation = false;

        $transacciones = (object) $this->get_api('/transaction/'.$id);

        //obtener información de un solo usuario
        $userConsulta = (object) $this->get_users_id($id);
        $user = null;
        if($userConsulta->status){
            $user = $userConsulta->data;
        }

        if(@$transacciones->data && !empty($transacciones->data))
            $status_trasation = true;

        $data = [
            'url_table' => $url_table,
            'status_trasation' => $status_trasation,
            'user' => $user
        ];

        return view('transacciones', $data);
    }

    /**
     * Autor Fredy Yela
     * Función para obtener todos los registros de usuarios pero solo realizar el filtrado para mostrar la información de un solo usuario
     * @param number
     * @return Array | Object
     */
    private function get_users_id($id){
        $result = (object) $this->get_api();
        $data = null;

        if(!$result->status){
            $response = [
                'code' => 400,
                'status' => false,
                'message' => 'Error al realizar la consulta',
                'message_api' => $result->message
            ];
        }

        
        $users = collect($result->data);
        $data = $users->where('id', $id)->first();

        $response = [
            'code' => 200,
            'status' => true,
            'message' => 'Usuarios consultados con exito',
            'data'    => $data,
        ];
        
        return $response;
               
    }

 
}
