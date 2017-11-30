<?php
use Illuminate\Support\Facades\Route;

    Route::group(['prefix' => 'autorizacao', 'middleware' => 'auth' ], function(){

        Route::any('perfis/{id}/permissoes/pesquisar', 'PerfilController@pesquisarPermissoes')->name('perfis.permissoes.pesquisar');
        Route::get('perfis/{id}/permissoes/{permissaoId}/delete', 'PerfilController@deletePermissao')->name('perfis.permissoes.delete');
        Route::post('perfis/{id}/permissoes/cadastrar', 'PerfilController@addPermissoes')->name('perfis.permissoes.add');
        Route::get('perfis/{id}/permissoes/cadastrar', 'PerfilController@permissoesParaAdd')->name('perfis.permissoes.cadastrar');
        Route::get('perfis/{id}/permissoes', 'PerfilController@permissoes')->name('perfis.permissoes');

        Route::any('perfis/{id}/usuarios/pesquisar', 'PerfilController@pesquisarUsuarios')->name('perfis.usuarios.pesquisar');
        Route::get('perfis/{id}/usuarios/{userId}/delete', 'PerfilController@deleteUser')->name('perfis.usuarios.delete');
        Route::post('perfis/{id}/usuarios/cadastrar', 'PerfilController@addUsuarios')->name('perfis.usuarios.add');
        Route::get('perfis/{id}/usuarios/cadastrar', 'PerfilController@usuariosParaAdd')->name('perfis.usuarios.cadastrar');
        Route::get('perfis/{id}/usuarios', 'PerfilController@usuarios')->name('perfis.usuarios');
        Route::any('perfis/pesquisar', 'PerfilController@pesquisar')->name('perfis.pesquisar');
        Route::resource('perfis', 'PerfilController');


        Route::any('permissoes/{id}/perfis/pesquisar', 'PermissaoController@pesquisarPerfis')->name('permissoes.perfis.pesquisar');
        Route::get('permissoes/{id}/perfis/{perfilId}/delete', 'PermissaoController@deletePerfil')->name('permissoes.perfis.delete');
        Route::post('permissoes/{id}/perfis/cadastrar', 'PermissaoController@addPerfil')->name('permissoes.perfis.add');
        Route::get('permissoes/{id}/perfis/cadastrar', 'PermissaoController@perfisParaAdd')->name('permissoes.perfis.cadastrar');
        Route::get('permissoes/{id}/perfis', 'PermissaoController@perfis')->name('permissoes.perfis');
        Route::any('permissoes/pesquisar', 'PermissaoController@pesquisar')->name('permissoes.pesquisar');
        Route::resource('permissoes', 'PermissaoController');




        Route::get('users/{id}/perfis/{perfilId}/delete', 'UserController@deletePerfil')->name('autorizacao_users.perfis.delete');
        Route::post('users/{id}/perfis/cadastrar', 'UserController@addPerfil')->name('autorizacao_users.perfis.add');
        Route::get('users/{id}/perfis/cadastrar', 'UserController@perfisParaAdd')->name('autorizacao_users.perfis.cadastrar');
        Route::any('users/{id}/perfis/pesquisar', 'UserController@pesquisarPerfis')->name('autorizacao_users.perfis.pesquisar');
        Route::get('users/{id}/perfis', 'UserController@perfis')->name('autorizacao_users.perfis');
        Route::any('users/pesquisar', 'UserController@pesquisar')->name('autorizacao_users.pesquisar');
        Route::resource('autorizacao_users', 'UserController')->only(['index', 'show']);

        

        
        Route::get('/', 'AutorizacaoController@index')->name('autorizacao');
    
    
    });