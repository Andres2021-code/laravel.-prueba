<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiController;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use Validator;

class ClienteController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data = [];
            $clientes = DB::table("clientes")
                ->join('tipo_documento' , 'tipo_documento.id' , '=' ,'clientes.tipo_doc')
                ->select("clientes.id", "tipo_documento.nombre_doc", "clientes.numero_cedula", "clientes.nombres", "clientes.apellidos", "clientes.direccion","clientes.telefono", "clientes.email")             
                ->get();
               


            $data['clientes'] = $clientes;
    
            return $this->sendResponse($data, "clientes recuperados correctamente");
    }

    public function listTypeDoc(){
        $data = [];

        $tpd = DB::table("tipo_documento")
            ->select("tipo_documento.id", "tipo_documento.nombre_doc")
            ->get();
  
        $data['tipo_documento'] = $tpd;
  
        return $this->sendResponse($data, "tipo de documentos recuperadss correctamente");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listOne($id)
    {
       $cliente = Cliente::find($id);

       if($cliente === null){
        return $this->sendErrors("Error en los datos", ["La activida no existe"], 422);
       }

       $data['cliente'] = $cliente;
    
       return $this->sendResponse($data, "clientes recuperado correctamente");
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
            'tipo_doc' => 'required|max:255',
            'numero_cedula' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'nombres' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required'
        ]);
        
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        $cliente = new Cliente();
        $cliente->tipo_doc = $request->get("tipo_doc");
        $cliente->numero_cedula = $request->get("numero_cedula");
        $cliente->apellidos = $request->get("apellidos");
        $cliente->nombres = $request->get("nombres");
        $cliente->direccion = $request->get("direccion");
        $cliente->telefono = $request->get("telefono");
        $cliente->email = $request->get("email");
        $cliente->save();

        $data = [
            'clientes' => $cliente
        ];
     

        return $this->sendResponse($data, "clientes creado correctamente");
   
    }


    
    public function update(Request $request)
    {
        $cliente = Cliente::find($request->get("id"));
        if($cliente === null){
            return $this->sendErrors("Error en los datos", ["El cliente no existe"], 200);
        }

        $validator = Validator::make($request->all(), [
            'tipo_doc' => 'required|max:255',
            'numero_cedula' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'nombres' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required'
        ]);
        
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $cliente->tipo_doc = $request->get("tipo_doc");
        $cliente->numero_cedula = $request->get("numero_cedula");
        $cliente->apellidos = $request->get("apellidos");
        $cliente->nombres = $request->get("nombres");
        $cliente->direccion = $request->get("direccion");
        $cliente->telefono = $request->get("telefono");
        $cliente->email = $request->get("email");
        $cliente->save();

        $data = [
            'clientes' => $cliente
        ];

        return $this->sendResponse($data, "clientes modificado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente === null) {
            return $this->sendErrors("Error en los datos", ["El cliente no existe"], 422);
        }

        $cliente->delete();


        return $this->sendResponse([
            'status' => "OK"
        ], "cliente borrado correctamente");
    }
}
