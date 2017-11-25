<?php

namespace  Manzoli2122\AAL\Http\Controllers;

use Illuminate\Http\Request;
use Manzoli2122\AAL\Models\Permissao;
use Manzoli2122\AAL\Models\Perfil;  

class PermissaoController extends StandardController
{
    

    protected $model;    
    protected $name = "Permissao";    
    protected $view = "admin::permissoes";    
    protected $route = "permissoes";
    
    
    public function __construct(Permissao $permissao){
        $this->model = $permissao;
        $this->middleware('can:permissoes');
        $this->middleware('can:permissoes_editar')->only(['edit' , 'update']);
    }






    public function perfis($id)
    {        
        $model = $this->model->find($id);
        $perfis = $model->perfis()->paginate($this->totalPage);
        $title = "Pperfis com permissão {$model->nome}";
        return view("{$this->view}.perfis", compact('model','perfis','title'));
    }




    public function perfisAdd($id)
    {            
        $model = $this->model->find($id);
        $perfis = Perfil::whereNotIn('id', function($query) use ($id){
            $query->select("permissao_perfils.perfil_id");
            $query->from("permissao_perfils");
            $query->whereRaw("permissao_perfils.permissao_id = {$id} ");
        } )->get();
        return view("{$this->view}.perfis-add", compact('model','perfis'));
    }


    
    public function deletePerfil($id,$perfilId)
    {        
        $model = $this->model->find($id);        
        $model->perfis()->detach($perfilId); 
        return redirect()->route('permissoes.perfis' ,$id)->with(['success' => 'Perfil Removido com sucesso']);
    }



    public function perfilAddPermissao(Request $request , $id)
    {        
        $model = $this->model->find($id);        
        $model->perfis()->attach($request->get('perfis'));            
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
