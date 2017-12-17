<?php

namespace  Manzoli2122\AAL\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config; 
use Auth;
use DataTables;
use App\Constants\ErrosSQL;

class PerfilController extends StandardDataTableController
{
 
        protected $model;   
        protected $permissao; 
        protected $user; 
        protected $name = "Perfil";    
        protected $view = "autorizacao::perfis";    
        protected $route = "perfis";
        
        
        
        public function __construct(){

            $usuarioModelName = Config::get('auth.providers.users.model');
            $this->user = new $usuarioModelName();

            $perfilModelName = Config::get('aal.perfil');
            $this->model = new $perfilModelName();

            $permissaoModelName = Config::get('aal.permissao');
            $this->permissao = new $permissaoModelName();
            
            $this->middleware('permissao:perfis');                     
            
        }




        /**
    * Processa a requisição AJAX do DataTable na página de listagem.
    * Mais informações em: http://datatables.yajrabox.com
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function getDatatable()
    {
        $models = $this->model->getDatatable();
        return Datatables::of($models)
            ->addColumn('action', function($linha) {
                return '<button data-id="'.$linha->id.'" btn-excluir type="button" class="btn btn-danger btn-xs" title="Excluir"> <i class="fa fa-times"></i> </button> '
                        . '<a href="'.route("{$this->route}.permissoes", $linha->id).'" class="btn btn-primary btn-xs" title="Permissões"> <i class="fa fa-pencil"></i> Permissões </a> '      
                        . '<a href="'.route("{$this->route}.usuarios", $linha->id).'" class="btn btn-primary btn-xs" title="Usuários"> <i class="fa fa-pencil"></i> Usuários </a> '      
                        . '<a href="'.route("{$this->route}.edit", $linha->id).'" class="btn btn-primary btn-xs" title="Editar"> <i class="fa fa-pencil"></i> </a> '   ;
            })->make(true);
    }




















        
        public function usuarios($id)
        {            
            $model = $this->model->find($id);
            $users = $model->usuarios()->get();
            return view("{$this->view}.usuarios", compact('model','users'));
        }





        public function usuariosParaAdd($id)
        {            
            $model = $this->model->find($id);
            $users =$this->user->usuarios_sem_perfil($id);
            return view("{$this->view}.usuarios-add", compact('model','users'));
        }


        

        public function deleteUser($id,$userId)
        {            
            $model = $this->model->find($id);  
            if($model->nome != 'Admin' or Auth::user()->hasPerfil('Admin'))          
                $model->detachUsuario($userId); 
            return redirect()->route("{$this->route}.usuarios" ,$id)->with(['success' => 'Usuarios Removido com sucesso']);
        }




        public function addUsuarios(Request $request , $id)
        {            
            $model = $this->model->find($id); 
            if($model->nome != 'Admin' or Auth::user()->hasPerfil('Admin'))
                $model->attachUsuario($request->get('users'));            
            return redirect()->route("{$this->route}.usuarios" ,$id)->with(['success' => 'Usuarios vinculados com sucesso']);
        }





        public function pesquisarUsuarios(Request $request , $id)
        {            
            $dataForm = $request->except('_token');
            $model = $this->model->find($id);
            $users = $model->usuarios()->where('name','LIKE', "%{$dataForm['key']}%")
                                       ->orWhere('users.email',$dataForm['key'])->get();           
            return view("{$this->view}.usuarios", compact('model', 'dataForm', 'users'));
        }





























        public function permissoes($id)
        {            
            $model = $this->model->find($id);           
            return view("{$this->view}.permissoes", compact('model'));
        }




        public function permissoesParaAdd($id)
        {            
            $model = $this->model->find($id);
            $permissoes = $this->permissao->permissos_sem_perfil($id);    
            return view("{$this->view}.permissoes-add", compact('model','permissoes'));
        }


        
        public function deletePermissao($id,$permissaoId)
        {            
            $model = $this->model->find($id);            
            $model->detachPermissao($permissaoId); 
            return redirect()->route("{$this->route}.permissoes" ,$id)->with(['success' => 'Permissa Removida com sucesso']);
        }





        public function addPermissoes(Request $request , $id)
        {            
            $model = $this->model->find($id);            
            $model->attachPermissao($request->get('permissoes'));            
            return redirect()->route("{$this->route}.permissoes" ,$id)->with(['success' => 'Permissoes vinculados com sucesso']);
        }



        

        public function pesquisarPemissoes(Request $request , $id)
        {            
            $dataForm = $request->except('_token');
            $model = $this->model->find($id);
            $permissoes = $model->permissoes()->where('nome','LIKE', "%{$dataForm['key']}%")->get();           
            return view("{$this->view}.permissoes", compact('model', 'dataForm', 'permissoes'));
        }
        
        

        
}
