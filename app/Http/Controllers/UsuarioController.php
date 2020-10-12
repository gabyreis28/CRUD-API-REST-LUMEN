<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
  protected $jwt;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(JWTAuth $jwt)
  {
    $this->jwt = $jwt;
    $this->middleware('auth:api',[
      'except' => ['usuarioLogin', 'cadastrarUsuarios','mostrarTodosUsuarios']
    ]);
  }

  public function usuarioLogin(Request $request)
  {
     $this->validate($request,[
      'email' => 'required|email|max:255',
      'password' => 'required'
    ]);

    //verificar se existe email e senha enviado na requisição
    if(! $token = $this->jwt->claims(['email' => $request->email])->attempt($request->only('email','password')))

    {
      return response()->json(['usuario não encontrado'], 404);
    }

    return response()->json(compact('token'));

  }

  public function mostrarUsuarioAutenticado()
  {
    $usuario = Auth::user();

    return response()->json($usuario);
  }

  public function mostrarTodosUsuarios()
  {
    //retorna todos os usuarios cadastrados no do banco
    return response()->json(Usuario::all());
  }

  public function cadastrarUsuarios(Request $request)
  {

    //validação
    $this->validate($request,[
      'usuario' => 'required|min:5|max:40',
      'email' => 'required|email|unique:usuarios,email',
      'password' => 'required'
    ]);

    $usuario = new Usuario;
    $usuario->email = $request->email;
    $usuario->usuario = $request->usuario;
    $usuario->password = Hash::make($request->password);
    
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
    return response()->json(["msg" => "Excluído com sucesso !"], 200);
  }

  public function usuarioLogout()
  {
    Auth::logout();

    return response()->json("Usuario deslogou com sucesso!");
  }

}