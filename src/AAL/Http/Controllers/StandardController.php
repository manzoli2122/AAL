<?php
namespace Manzoli2122\AAL\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class StandardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $totalPage = 10;

    protected $upload = false;



    public function index()
    {        
        $models = $this->model::paginate($this->totalPage);
        return view("{$this->view}.index", compact('models'));
    }




    public function create()
    {
        return view("{$this->view}.create-edit");
    }






    public function store(Request $request)
    {
        $this->validate($request , $this->model->rules());
        $dataForm = $request->all();              
        $insert = $this->model->create($dataForm);          
        if($insert){
            return redirect()->route("{$this->route}.index")->with(['success' => 'Cadastro realizado com sucesso']);
        }
        else {
            return redirect()->route("{$this->route}.create")->withErrors(['errors' =>'Erro no Cadastro'])->withInput();
        }

    }





    public function show($id)
    {
        $model = $this->model->find($id);
        return view("{$this->view}.show", compact('model'));
    }









   
    public function edit($id)
    {
        $model = $this->model->find($id);
        return view("{$this->view}.create-edit", compact('model'));
    }






    public function update( Request $request, $id)
    {
        $this->validate($request , $this->model->rules($id));        
        $dataForm = $request->all();                     
        $model = $this->model->find($id);                 
        $update = $model->update($dataForm);                
        if($update){
            return redirect()->route("{$this->route}.show" , ['id'=> $id])->with(['success' => 'Alteração realizada com sucesso']);
        }        
        else {
            return redirect()->route("{$this->route}.edit" , ['id'=> $id])->withErrors(['errors' =>'Erro no Editar'])->withInput();
        }
    }







    public function destroy($id)
    {
        $model = $this->model->find($id);
        $delete = $model->delete();
        if($delete){
            return redirect()->route("{$this->route}.index");
        }
        else{
            return  redirect()->route("{$this->route}.show",['id' => $id])->withErrors(['errors' => 'Falha ao Deletar']);
        }
    }




    
    public function pesquisar(Request $request)
    {       
        $dataForm = $request->except('_token');
        $models = $this->model->where('nome','LIKE', "%{$dataForm['key']}%")->paginate($this->totalPage);       
        return view("{$this->view}.index", compact('models', 'dataForm'));

    }




}

