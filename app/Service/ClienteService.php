<?php

namespace App\Service;

use App\Models\Endereco;
use App\Models\Usuario;
use log;

class ClienteService{

    public function salvarUsuario(Usuario $user, Endereco $endereco){
       $dbUsuario = Usuario::where("login", $user->login)->first();
       if($dbUsuario){
        return ['status' => 'erro', 'message' => 'Usuario ja cadastrado'];
       }
       
        $user->save();
        $endereco->usuario_id = $user->id;
        $endereco->save();

        return ['status' => 'ok', 'message' => 'Usuario cadastrado com sucesso'];
    }
}
