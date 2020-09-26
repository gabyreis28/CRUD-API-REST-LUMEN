<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  public function mostrarTodosUsuarios()
  {
    //retorna todos os usuarios cadastrados no do banco
    return response()->json(Usuario::all());
  }

  public function cadastrarUsuarios(Request $request)
  {

    $usuario = new Usuario;
    $usuario->email = $request->email;
    $usuario->usuario = $request->usuario;
    $usuario->password = $request->password;
    
    //Salvar registro no banco
    $usuario->save();
    return response()->json($usuario);
    
    // testando método.Retornando uma mensagem em json
    // return response()->json("Cadastrando Usuario");

    //chama todo o corpo(body) da requisição
    // return response()->json($request->all());

  }

  public function mostarUmUsuario($id)
  {

    //retorna o usuario informado pelo id
    return response()->json(Usuario::find($id));
  }

  public function atualizarUsuario($id, Request $request)
  {

    //armazena o usuario que está no banco, pega o usuario informado pelo id
    $usuario = Usuario::find($id);

    $usuario->email = $request->email;
    $usuario->usuario = $request->usuario;
    $usuario->password = $request->password;

     //Salvar as alterações no banco
     $usuario->save();
     return response()->json($usuario);
  }

  public function deletarUsuario($id)
  {
    //armazena o usuario que está no banco, pega o usuario informado pelo id
    $usuario = Usuario::find($id);

    //excluir usuario
    $usuario->delete();

    //retorna mensagem e status 200
    return response()->json('Excluído com sucesso !',200);
  }

}