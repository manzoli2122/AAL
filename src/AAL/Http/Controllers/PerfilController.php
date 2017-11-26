<?php

namespace  Manzoli2122\AAL\Http\Controllers;

use Illuminate\Http\Request;
use Manzoli2122\AAL\Models\Perfil;
use Manzoli2122\AAL\Models\Permissao;  
//use Manzoli2122\AAL\Models\User; 
use Illuminate\Support\Facades\Config; 

class PerfilController extends StandardController
{
 
        protected $model;    
        protected $user; 
        protected $name = "Perfil";    
        protected $view = "autorizacao::perfis";    
        protected $route = "perfis";
        
        
        public function __construct(Perfil $perfil){
            $usuarioModelName = Config::get('auth.providers.users.model');
            $this->user = new $usuarioModelName();
            $this->model = $perfil;

            //$this->middleware('can:perfis');
            //$this->middleware('can:perfis_editar')->only(['edit' , 'update']);           
            
        }






        public function usuarios($id)
        {            
            $model = $this->model->find($id);
            $users = $model->usuarios()->paginate($this->totalPage);
            $title = "Usuarios com o perfil {$model->nome}";
            return view("{$this->view}.usuarios", compact('model','users','title'));
        }


        public function usuariosAdd($id)
        {            
            $model = $this->model->find($id);

            $users =$this->user->whereNotIn('id', function($query) use ($id){
                $query->select("perfils_users.user_id");
                $query->from("perfils_users");
                $query->whereRaw("perfils_users.perfil_id = {$id} ");
            } )->get();            
            return view("{$this->view}.usuarios-add", compact('model','users'));
        }


        
        public function deleteUser($id,$userId)
        {            
            $model = $this->model->find($id);            
            $model->usuarios()->detach($userId); 
            return redirect()->route('perfis.usuarios' ,$id)->with(['success' => 'Usuarios Removido com sucesso']);
        }



        public function usuariosAddPerfil(Request $request , $id)
        {            
            $model = $this->model->find($id);            
            $model->usuarios()->attach($request->get('users'));            
            return redirect()->route('perfis.usuarios' ,$id)->with(['success' => 'Usuarios vinculados com sucesso']);
        }


        public function pesquisarUsuarios(Request $request , $id)
        {            
            $dataForm = $request->except('_token');
            $model = $this->model->find($id);
            $users = $model->usuarios()->where('users.name','LIKE', "%{$dataForm['key']}%")
                                       ->orWhere('users.email',$dataForm['key'])->paginate($this->totalPage);
           
            return view("{$this->view}.usuarios", compact('model', 'dataForm', 'users'));
        }





























        public function permissoes($id)
        {            
            $model = $this->model->find($id);
            $permissoes = $model->permissoes()->paginate($this->totalPage);
            $title = "permissoes do perfil {$model->nome}";
            return view("{$this->view}.permissoes", compact('model','permissoes','title'));
        }


        public function permissoesAdd($id)
        {            
            $model = $this->model->find($id);

            $permissoes = Permissao::whereNotIn('id', function($query) use ($id){
                $query->select("permissao_perfils.permissao_id");
                $query->from("permissao_perfils");
                $query->whereRaw("permissao_perfils.perfil_id = {$id} ");
            } )->get();            
            return view("{$this->view}.permissoes-add", compact('model','permissoes'));
        }


        
        public function deletePermissao($id,$permissaoId)
        {            
            $model = $this->model->find($id);            
            $model->permissoes()->detach($permissaoId); 
            return redirect()->route('perfis.permissoes' ,$id)->with(['success' => 'Permissa Removida com sucesso']);
        }



        public function permissoesAddPerfil(Request $request , $id)
        {            
            $model = $this->model->find($id);            
            $model->permissoes()->attach($request->get('permissoes'));            
            return redirect()->route('perfis.permissoes' ,$id)->with(['success' => 'Permissoes vinculados com sucesso']);
        }


        public function pesquisarPemissoes(Request $request , $id)
        {            
            $dataForm = $request->except('_token');
            $model = $this->model->find($id);
            $permissoes = $model->permissoes()->where('permissoes.nome','LIKE', "%{$dataForm['key']}%")
                                       ->paginate($this->totalPage);
           
            return view("{$this->view}.permissoes", compact('model', 'dataForm', 'permissoes'));
        }
        
        

        
}
