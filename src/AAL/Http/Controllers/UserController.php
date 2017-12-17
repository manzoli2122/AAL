<?php

namespace  Manzoli2122\AAL\Http\Controllers;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use App\Constants\ErrosSQL;
use Config;

class UserController extends StandardDataTableController
{
    
    protected $totalPage = 10;
    private $user ;
    protected $perfil ;
    protected $name  = "Usuario";    
    protected $view  = "autorizacao::usuarios";    
    protected $route = "autorizacao_users";
    
    public function __construct(){

        $usuarioModelName = Config::get('auth.providers.users.model');
        $this->user = new $usuarioModelName();

        $perfilModelName = Config::get('aal.perfil');
        $this->perfil = new $perfilModelName();

        $this->middleware('permissao:usuarios');
    }




 /**
    * Processa a requisição AJAX do DataTable na página de listagem.
    * Mais informações em: http://datatables.yajrabox.com
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function getDatatable()
    {
        $models = $this->user->getDatatable();
        return Datatables::of($models)
            ->addColumn('action', function($linha) {
                return  '<a href="'.route("{$this->route}.perfis", $linha->id).'" class="btn btn-primary btn-xs" title="Perfis"> <i class="fa fa-user"></i> Perfis </a> '   ;
            })->make(true);
    }





    
    public function perfis($id)
    {        
        $model = $this->user->find($id);
        return view("{$this->view}.perfis", compact('model'));
    }




    
    public function perfisParaAdd($id)
    {    
        $model = $this->user->find($id);
        $perfis = $this->perfil->perfils_sem_usuario($id, Auth::user()->hasPerfil('Admin'));
        return view("{$this->view}.perfis-add", compact('model','perfis'));  
    }




    
    public function addPerfil(Request $request , $id)
    {        
        $model = $this->user->find($id);  
        foreach ($request->get('perfis') as  $value) {
            $perfil = $this->perfil->find($value);
            if( $perfil->nome != 'Admin' or Auth::user()->hasPerfil('Admin'))
                $model->attachPerfil($value);
        }
        return redirect()->route("{$this->route}.perfis" ,$id)->with(['success' => 'Perfis vinculados com sucesso']);
    }





    
    public function deletePerfil($id,$perfilId)
    {        
        $model = $this->user->find($id);
        $perfil = $this->perfil->find($perfilId);
        if( $perfil->nome == 'Admin' and ! Auth::user()->hasPerfil('Admin'))
            return redirect()->route("{$this->route}.perfis" ,$id)->with(['error' => 'Perfil não pode ser Removido']);
        $model->detachPerfil($perfilId);   
        return redirect()->route("{$this->route}.perfis" ,$id)->with(['success' => 'Perfil Removido com sucesso']);
    }


}
