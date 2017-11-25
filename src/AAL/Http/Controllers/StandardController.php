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



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Listagem dos {$this->name}";
        $models = $this->model::paginate($this->totalPage);
        return view("{$this->view}.index", compact('models', 'title'));
    }








    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar {$this->name}";
        return view("{$this->view}.create-edit", compact('title'));
    }













    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , $this->model->rules());
        $dataForm = $request->all();              
        $insert = $this->model->create($dataForm);        
        if($this->upload){
            if($request->hasFile($this->upload['name'])){
                $image = $request->file($this->upload['name']);               
                $nameFile = uniqid(date('YmdHis')).'.'. $image->getClientOriginalExtension();                
                $upload = $image->storeAs($this->upload['path'], $nameFile );
                if($upload){
                    $dataUser[$this->upload['name']] = $nameFile;
                }
                else 
                    return redirect()->route("{$this->route}.create")->withErrors(['errors' =>'Erro no upload'])->withInput();
            }
        }
        if($insert){
            return redirect()->route("{$this->route}.index")->with(['success' => 'Cadastro realizado com sucesso']);
        }
        else {
            return redirect()->route("{$this->route}.create")->withErrors(['errors' =>'Erro no Cadastro'])->withInput();
        }

    }













    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Visualizando {$this->name}";
        $model = $this->model->find($id);
        return view("{$this->view}.show", compact('model'));
    }









    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Editar {$this->name}";
        $model = $this->model->find($id);
        return view("{$this->view}.create-edit", compact('model'));
    }














    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id)
    {
        $this->validate($request , $this->model->rules($id));
        
        $dataForm = $request->all();              
        
        $model = $this->model->find($id);   

        if($this->upload){
            if($request->hasFile($this->upload['name'])){
                $image = $request->file($this->upload['name']);
                
                if($model->image == ''){
                    $nameFile = uniqid(date('YmdHis')).'.'. $image->getClientOriginalExtension(); 
                    $dataForm[$this->upload['name']] = $nameFile;
                }
                $upload = $image->storeAs($this->upload['path'], $nameFile );
                if($upload){
                    $dataForm[$this->upload['name']] = $nameFile;
                }
                else{                
                    return redirect()->route("{$this->route}.edit")->withErrors(['errors' =>'Erro no upload'])->withInput();
                }
            }
        }

        
        $update = $model->update($dataForm);        
        
        if($update){
            return redirect()->route("{$this->route}.index")->with(['success' => 'Alteração realizada com sucesso']);
        }        
        else {
            return redirect()->route("{$this->route}.edit" , ['id'=> $id])->withErrors(['errors' =>'Erro no Editar'])->withInput();
        }
    }








    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pesquisar(Request $request)
    {
        
        $dataForm = $request->except('_token');

        $models = $this->model->where('nome','LIKE', "%{$dataForm['key']}%")->paginate($this->totalPage);
       
        return view("{$this->view}.index", compact('models', 'dataForm'));

    }




}

