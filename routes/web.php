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
$router->post('/usuarios/cadastrar', 'UsuarioController@cadastrarUsuarios');
$router->get('/usuario/{id}', 'UsuarioController@mostarUmUsuario');
$router->put('/usuario/{id}/atualizar', 'UsuarioController@atualizarUsuario');
$router->delete('/usuario/{id}/deletar', 'UsuarioController@deletarUsuario');