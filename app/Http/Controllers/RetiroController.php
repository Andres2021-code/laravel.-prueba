<?php

namespace App\Http\Controllers;

use App\Retiro;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiController;
use Illuminate\Support\Facades\DB;
use Validator;

class RetiroController extends ApiController
{
    public function index()
    {
        $retiros = DB::table("retiros")
        ->join('cuentas' , 'cuentas.id' , '=' ,'retiros.id_cuenta')
        ->join('users' , 'users.id' , '=' ,'retiros.id_usuario')
        ->select("retiros.id", "retiros.codigo_retiro","retiros.id_usuario",  
        "users.nombre_usuario", "cuentas.descripcion as descripcion_cuenta", "retiros.valor_retiro", 
        "retiros.descripcion")             
        ->get();
       
    $data['retiros'] = $retiros;

    return $this->sendResponse($data, "retiros recuperados correctamente");
        
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listOne($id)
    {
       $retiros = Retiro::find($id);

       if($retiros === null){
        return $this->sendErrors("Error en los datos", ["El retiros no existe"], 422);
       }

       $data['retiros'] = $retiros;
    
       return $this->sendResponse($data, "retiro recuperado correctamente");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'codigo_retiro' => 'required|max:255',
            'id_usuario' => 'required|max:255',
            'id_cuenta' => 'required|max:255',
            'valor_retiro' => 'required',
            'descripcion' => 'required'
        ]);
        
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        $retiros = new Retiro();
        $retiros->codigo_retiro = $request->get("codigo_retiro");
        $retiros->id_usuario = $request->get("id_usuario");
        $retiros->id_cuenta = $request->get("id_cuenta");
        $retiros->valor_retiro = $request->get("valor_retiro");
        $retiros->descripcion = $request->get("descripcion");

        $retiros->save();

        $data = [
            'retiross' => $retiros
        ];
     

        return $this->sendResponse($data, "retiross creado correctamente");
   
    }


    
    public function update(Request $request)
    {
        $retiros = Retiro::find($request->get("id"));
        if($retiros === null){
            return $this->sendErrors("Error en los datos", ["el retiros no existe"], 200);
        }

      
        $validator = Validator::make($request->all(), [
            'codigo_retiro' => 'required|max:255',
            'id_usuario' => 'required|max:255',
            'id_cuenta' => 'required|max:255',
            'valor_retiro' => 'required',
            'descripcion' => 'required'
        ]);
        
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $retiros->codigo_retiro = $request->get("codigo_retiro");
        $retiros->id_usuario = $request->get("id_usuario");
        $retiros->id_cuenta = $request->get("id_cuenta");
        $retiros->valor_retiro = $request->get("valor_retiro");
        $retiros->descripcion = $request->get("descripcion");

        $retiros->save();

        $data = [
            'retiros' => $retiros
        ];
     
        return $this->sendResponse($data, "retiro modificado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $retiros = Retiro::find($id);
        if ($retiros === null) {
            return $this->sendErrors("Error en los datos", ["El retiros no existe"], 422);
        }

        $retiros->delete();


        return $this->sendResponse([
            'status' => "OK"
        ], "retiros borrado correctamente");
    }
}
