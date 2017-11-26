<?php
use Illuminate\Support\Facades\Route;

    Route::group(['prefix' => 'autorizacao', 'middleware' => 'auth' ], function(){

        Route::any('perfis/{id}/permissoes/pesquisar', 'PerfilController@pesquisarPermissoes')->name('perfis.permissoes.pesquisar');
        Route::get('perfis/{id}/permissoes/{permissaoId}/delete', 'PerfilController@deletePermissao')->name('perfis.permissoes.delete');
        Route::post('perfis/{id}/permissoes/cadastrar', 'PerfilController@permissoesAddPerfil')->name('perfis.permissoes.add');
        Route::get('perfis/{id}/permissoes/cadastrar', 'PerfilController@permissoesAdd')->name('perfis.permissoes.cadastrar');
        Route::get('perfis/{id}/permissoes', 'PerfilController@permissoes')->name('perfis.permissoes');

        Route::any('perfis/{id}/usuarios/pesquisar', 'PerfilController@pesquisarUsuarios')->name('perfis.usuarios.pesquisar');
        Route::get('perfis/{id}/usuarios/{userId}/delete', 'PerfilController@deleteUser')->name('perfis.usuarios.delete');
        Route::post('perfis/{id}/usuarios/cadastrar', 'PerfilController@usuariosAddPerfil')->name('perfis.usuarios.add');
        Route::get('perfis/{id}/usuarios/cadastrar', 'PerfilController@usuariosAdd')->name('perfis.usuarios.cadastrar');
        Route::get('perfis/{id}/usuarios', 'PerfilController@usuarios')->name('perfis.usuarios');
        Route::any('perfis/pesquisar', 'PerfilController@pesquisar')->name('perfis.pesquisar');
        Route::resource('perfis', 'PerfilController');


        Route::any('permissoes/{id}/perfis/pesquisar', 'PermissaoController@pesquisarPerfis')->name('permissoes.perfis.pesquisar');
        Route::get('permissoes/{id}/perfis/{perfilId}/delete', 'PermissaoController@deletePerfil')->name('permissoes.perfis.delete');
        Route::post('permissoes/{id}/perfis/cadastrar', 'PermissaoController@perfilAddPermissao')->name('permissoes.perfis.add');
        Route::get('permissoes/{id}/perfis/cadastrar', 'PermissaoController@perfisAdd')->name('permissoes.perfis.cadastrar');
        Route::get('permissoes/{id}/perfis', 'PermissaoController@perfis')->name('permissoes.perfis');
        Route::any('permissoes/pesquisar', 'PermissaoController@pesquisar')->name('permissoes.pesquisar');
        Route::resource('permissoes', 'PermissaoController');




        Route::get('users/{id}/perfis/{perfilId}/delete', 'UserController@deletePerfil')->name('autorizacao.users.perfis.delete');
        Route::post('users/{id}/perfis/cadastrar', 'UserController@perfilAddUsuarios')->name('autorizacao.users.perfis.add');
        Route::get('users/{id}/perfis/cadastrar', 'UserController@perfisAdd')->name('autorizacao.users.perfis.cadastrar');
        Route::any('users/{id}/perfis/pesquisar', 'UserController@pesquisarPerfis')->name('autorizacao.users.perfis.pesquisar');
        Route::get('users/{id}/perfis', 'UserController@perfis')->name('autorizacao.users.perfis');
        Route::any('users/pesquisar', 'UserController@pesquisar')->name('autorizacao.users.pesquisar');
        Route::resource('users', 'UserController');

        

        
        Route::get('/', 'AutorizacaoController@index')->name('autorizacao');
    
    
    });