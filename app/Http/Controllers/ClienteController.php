<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Endereco;
use App\Service\ClienteService;
class ClienteController extends Controller
{
   public function cadastrar(Request $request){
        $data = [];
        return view("cadastrar", $data);
   }
   public function cadastrarCliente(Request $request){

      $values = $request->all();
      $usuario = new Usuario();
      $usuario->fill($values);
      $usuario->login = $request->input("cpf", "");

      $endereco = new Endereco($values);
      $endereco -> logradouro = $request->input("endereco", "");
    
     
        
         $usuario->save();
         $endereco->usuario_id = $usuario->id;
         $endereco->save();
       
    $clienteService = new ClienteService();
    $result = $clienteService->salvarUsuario($usuario, $endereco);

    $message = $result["message"];
    $status = $result["status"];

    $request->session()->flash($status, "message");
  
      return redirect()->route("cadastrar");
   }
}
