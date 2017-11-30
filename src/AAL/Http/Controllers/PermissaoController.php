<?php

namespace  Manzoli2122\AAL\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Config; 

class PermissaoController extends StandardController
{
    

    protected $model;    
    protected $perfil;
    protected $name = "Permissao";    
    protected $view = "autorizacao::permissoes";    
    protected $route = "permissoes";
    
    
    public function __construct(){
        
        $perfilModelName = Config::get('aal.perfil');
        $this->perfil = new $perfilModelName();

        $permissaoModelName = Config::get('aal.permissao');
        $this->model = new $permissaoModelName();
        
        $this->middleware('permissao:permissoes');
       
    }






    public function perfis($id)
    {        
        $model = $this->model->find($id);
        return view("{$this->view}.perfis", compact('model'));
    }

 



    public function perfisParaAdd($id)
    {            
        $model = $this->model->find($id);
        $perfis = $this->perfil->perfils_sem_permissao($id);
        return view("{$this->view}.perfis-add", compact('model','perfis'));
    }


    

    
    public function deletePerfil($id,$perfilId)
    {        
        $model = $this->model->find($id);        
        $model->detachPerfil($perfilId); 
        return redirect()->route("{$this->route}.perfis" ,$id)->with(['success' => 'Perfil Removido com sucesso']);
    }





    public function addPerfil(Request $request , $id)
    {        
        $model = $this->model->find($id);        
        $model->attachPerfil($request->get('perfis'));            
        return redirect()->route("{$this->route}.perfis" ,$id)->with(['success' => 'Perfis vinculados com sucesso']);
    }





    public function pesquisarPerfis(Request $request , $id)
    {
        $dataForm = $request->except('_token');
        $model = $this->model->find($id);
        $perfis = $model->perfis()->where('permissoes.nome','LIKE', "%{$dataForm['key']}%")
                                   ->paginate($this->totalPage);       
        return view("{$this->view}.perfis", compact('model', 'dataForm', 'perfis'));
    }



}
