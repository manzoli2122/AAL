<?php

namespace  Manzoli2122\AAL\Http\Controllers;

use Illuminate\Http\Request;
use Manzoli2122\AAL\Models\Permissao;
use Manzoli2122\AAL\Models\Perfil;  

class PermissaoController extends StandardController
{
    

    protected $model;    
    protected $perfil;
    protected $name = "Permissao";    
    protected $view = "autorizacao::permissoes";    
    protected $route = "permissoes";
    
    
    public function __construct(Permissao $permissao , Perfil $perfil){
        $this->model = $permissao;
        $this->perfil = $perfil;
        $this->middleware('permissao:permissoes');
        //$this->middleware('can:permissoes_editar')->only(['edit' , 'update']);
    }






    public function perfis($id)
    {        
        $model = $this->model->find($id);
        return view("{$this->view}.perfis", compact('model'));
    }

 



    public function perfisAdd($id)
    {            
        $model = $this->model->find($id);
        $perfis = $this->perfil->perfils_sem_permissao($id);
        return view("{$this->view}.perfis-add", compact('model','perfis'));
    }


    
    public function deletePerfil($id,$perfilId)
    {        
        $model = $this->model->find($id);        
        $model->detachPerfil($perfilId); 
        return redirect()->route('permissoes.perfis' ,$id)->with(['success' => 'Perfil Removido com sucesso']);
    }



    public function perfilAddPermissao(Request $request , $id)
    {        
        $model = $this->model->find($id);        
        $model->attachPerfil($request->get('perfis'));            
        return redirect()->route('permissoes.perfis' ,$id)->with(['success' => 'Perfis vinculados com sucesso']);
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
