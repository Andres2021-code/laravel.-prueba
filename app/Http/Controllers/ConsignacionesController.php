<?php

namespace App\Http\Controllers;

use App\Consignaciones;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiController;
use Illuminate\Support\Facades\DB;
use Validator;

class ConsignacionesController extends ApiController
{
    public function index()
    {
        $consignaciones = DB::table("consignaciones")
        ->join('cuentas' , 'cuentas.id' , '=' ,'consignaciones.id_cuenta')
        ->join('users' , 'users.id' , '=' ,'consignaciones.id_usuario')
        ->select("consignaciones.id", "consignaciones.id_cuenta","consignaciones.id_usuario", "consignaciones.codigo_consignaciones", 
        "users.nombre_usuario", "cuentas.descripcion", "consignaciones.valor_consignacion", 
        "consignaciones.descripcion_consignacion")             
        ->get();
       
    $data['consignaciones'] = $consignaciones;

    return $this->sendResponse($data, "consignaciones recuperados correctamente");
        
    }

    public function listUsers(){
        $data = [];

        $tpd = DB::table("users")
            ->select("users.id", "users.nombre_usuario")
            ->get();
  
        $data['users'] = $tpd;
  
        return $this->sendResponse($data, "tipo de documentos recuperadss correctamente");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listOne($id)
    {
       $consignaciones = Consignaciones::find($id);

       if($consignaciones === null){
        return $this->sendErrors("Error en los datos", ["La consignaciones no existe"], 422);
       }

       $data['consignaciones'] = $consignaciones;
    
       return $this->sendResponse($data, "consigacion recuperada correctamente");
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
            'codigo_consignaciones' => 'required|max:255',
            'id_usuario' => 'required|max:255',
            'id_cuenta' => 'required|max:255',
            'valor_consignacion' => 'required',
            'descripcion_consignacion' => 'required'
        ]);
        
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        $consignaciones = new Consignaciones();
        $consignaciones->codigo_consignaciones = $request->get("codigo_consignaciones");
        $consignaciones->id_usuario = $request->get("id_usuario");
        $consignaciones->id_cuenta = $request->get("id_cuenta");
        $consignaciones->valor_consignacion = $request->get("valor_consignacion");
        $consignaciones->descripcion_consignacion = $request->get("descripcion_consignacion");

        $consignaciones->save();

        $data = [
            'consignacioness' => $consignaciones
        ];
     

        return $this->sendResponse($data, "consignacioness creado correctamente");
   
    }


    
    public function update(Request $request)
    {
        $consignaciones = Consignaciones::find($request->get("id"));
        if($consignaciones === null){
            return $this->sendErrors("Error en los datos", ["la consignaciones no existe"], 422);
        }

      
        $validator = Validator::make($request->all(), [
            'codigo_consignaciones' => 'required|max:255',
            'id_usuario' => 'required|max:255',
            'id_cuenta' => 'required|max:255',
            'valor_consignacion' => 'required',
            'descripcion_consignacion' => 'required'
        ]);
        
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $consignaciones->codigo_consignaciones = $request->get("codigo_consignaciones");
        $consignaciones->id_usuario = $request->get("id_usuario");
        $consignaciones->id_cuenta = $request->get("id_cuenta");
        $consignaciones->valor_consignacion = $request->get("valor_consignacion");
        $consignaciones->descripcion_consignacion = $request->get("descripcion_consignacion");

        $consignaciones->save();

        $data = [
            'consignacioness' => $consignaciones
        ];
     
        return $this->sendResponse($data, "consignaciones modificado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consignaciones = Consignaciones::find($id);
        if ($consignaciones === null) {
            return $this->sendErrors("Error en los datos", ["El consignaciones no existe"], 422);
        }

        $consignaciones->delete();


        return $this->sendResponse([
            'status' => "OK"
        ], "consignaciones borrado correctamente");
    }
}
