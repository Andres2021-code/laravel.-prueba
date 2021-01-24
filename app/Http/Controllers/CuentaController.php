<?php

namespace App\Http\Controllers;

use App\Cuenta;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiController;
use Illuminate\Support\Facades\DB;
use Validator;

class CuentaController extends ApiController
{
    public function index()
    {
        
            $cuentas = DB::table("cuentas")
                ->join('clientes' , 'clientes.id' , '=' ,'cuentas.id_cliente')
                ->select("cuentas.id", "cuentas.numero_cuenta", "clientes.nombres", "cuentas.saldo", "cuentas.activa", "cuentas.clave_cuenta", "cuentas.descripcion")             
                ->get();
               
            $data['cuentas'] = $cuentas;
    
            return $this->sendResponse($data, "cuentas recuperados correctamente");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listOne($id)
    {
       $cuenta = Cuenta::find($id);

       if($cuenta === null){
        return $this->sendErrors("Error en los datos", ["La activida no existe"], 422);
       }

       $data['cuenta'] = $cuenta;
    
       return $this->sendResponse($data, "cuentas recuperado correctamente");
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
            'numero_cuenta' => 'required|max:255',
            'id_cliente' => 'required|max:255',
            'saldo' => 'required|max:255',
            'activa' => 'required',
            'clave_cuenta' => 'required',
            'descripcion' => 'required',
        ]);
        
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        $Cuenta = new Cuenta();
        $Cuenta->numero_cuenta = $request->get("numero_cuenta");
        $Cuenta->id_cliente = $request->get("id_cliente");
        $Cuenta->saldo = $request->get("saldo");
        $Cuenta->activa = $request->get("activa");
        $Cuenta->clave_cuenta = $request->get("clave_cuenta");
        $Cuenta->descripcion = $request->get("descripcion");
        $Cuenta->save();

        $data = [
            'cuentas' => $Cuenta
        ];
     

        return $this->sendResponse($data, "cuentas creado correctamente");
   
    }


    
    public function update(Request $request)
    {
        $Cuenta = Cuenta::find($request->get("id"));
        if($Cuenta === null){
            return $this->sendErrors("Error en los datos", ["la Cuenta no existe"], 200);
        }

        $validator = Validator::make($request->all(), [
            'numero_cuenta' => 'required|max:255',
            'id_cliente' => 'required|max:255',
            'saldo' => 'required|max:255',
            'activa' => 'required',
            'clave_cuenta' => 'required',
            'descripcion' => 'required',
        ]);
        
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $Cuenta->numero_cuenta = $request->get("numero_cuenta");
        $Cuenta->id_cliente = $request->get("id_cliente");
        $Cuenta->saldo = $request->get("saldo");
        $Cuenta->activa = $request->get("activa");
        $Cuenta->clave_cuenta = $request->get("clave_cuenta");
        $Cuenta->descripcion = $request->get("descripcion");
        $Cuenta->save();

        $data = [
            'cuentas' => $Cuenta
        ];

        return $this->sendResponse($data, "cuentas modificado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Cuenta = Cuenta::find($id);
        if ($Cuenta === null) {
            return $this->sendErrors("Error en los datos", ["El Cuenta no existe"], 422);
        }

        $Cuenta->delete();


        return $this->sendResponse([
            'status' => "OK"
        ], "Cuenta borrado correctamente");
    }
}
