<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->get('/teste', function () use ($router) {
//     return '[routes/web.php] Metodo Get URL: /teste';
// });

$router->get('/usuarios', 'UsuarioController@mostrarTodosUsuarios');

//Grupo de Rotas
$router->group(['prefix' => 'usuario'], function () use ($router){
    $router->post('/cadastrar', 'UsuarioController@cadastrarUsuarios');
    $router->get('/{id}', 'UsuarioController@mostarUmUsuario');
    $router->put('/{id}/atualizar', 'UsuarioController@atualizarUsuario');
    $router->delete('/{id}/deletar', 'UsuarioController@deletarUsuario');
    
});

$router->post('/login','UsuarioController@usuarioLogin');
$router->post('/info','UsuarioController@mostrarUsuarioAutenticado');
$router->post('/logout','UsuarioController@usuarioLogout');


