<?php

namespace App\Http\Controllers\API;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
  public function test(Request $request)
  {
    $user = Auth::user();
    return $this->sentResponse($user, "usuarios en session");
  }

  public function register(Request $request)
  {
      
    $validacion = Validator::make($request->all(), [
        'nombre_usuario' => 'required',
        'usuario_cedula' => 'required', 
        'email' => 'required|email',
        'password' => 'required',
        'tipo_id' => '',
    ]);

    if($validacion->fails()){
      return $this->sentErrors("usuarios en session", $validacion->errors(),  422);

      return response()->json(["error"=>$validacion->errors()], 422);
    }

    $input = $request->all();
    $input["password"] = bcrypt($request->get("password"));
    $user = User::create($input);
    $token = $user->createToken("eccotech")->accessToken;

    $data =    [
      "token"=>$token,
      "user" =>$user
    ];
    return $this->sentResponse($data, "usuarios registrado correctamente");

  }
}
