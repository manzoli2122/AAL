<?php

namespace  Manzoli2122\AAL\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\User;
use App\Modules\Admin\Models\Perfil;
use App\Http\Requests\Painel\UserFormRequest;
use Auth;
use Carbon\Carbon;
class UserController extends Controller
{
    
    protected $totalPage = 10;

    private $user ;
    
    public function __construct(User $user){
        $this->user = $user;
        
        $this->middleware('can:usuarios');
        $this->middleware('can:usuarios_editar')->only(['edit' , 'update']);
        $this->middleware('can:usuarios_perfis')->only(['perfis' , 'perfisAdd' , 'perfilAddUsuarios' , 'deletePerfil']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = 'Listagem dos usuarios';
        $users = $this->user::paginate($this->totalPage);
        return view('admin::usuarios.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::usuarios.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $dataUser = $request->all();
        $dataUser['password'] = bcrypt($dataUser['password']);

        if($request->hasFile('image')){
            $image = $request->file('image');
           
            $nameImage = uniqid(date('YmdHis')).'.'. $image->getClientOriginalExtension();
            $upload = $image->storeAs('users', $nameImage );
            if($upload){
                $dataUser['image'] = $nameImage;
            }
            else 
                return redirect('painel/usuarios/create')->withErrors(['errors' =>'Erro no upload'])->withInput();
        }


        $insert = $this->user->create($dataUser);
        
        if($insert){
            return redirect()->route('users.index')->with(['success' => 'Cadastro realizado com sucesso']);
        }
        else {
            return redirect()->route('users.create')->withErrors(['errors' =>'Erro no Cadastro'])->withInput();
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
        $user = $this->user->find($id);
        return view('admin::usuarios.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
        return view('admin::usuarios.create-edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {
        $dataUser = $request->all();        
        $user = $this->user->find($id);
        $dataUser['password'] = bcrypt($dataUser['password']);     
        
        if( $request->hasFile('image')){
            $image =  $request->file('image'); 
            if(!$user->image ){
                $user->image = uniqid(date('YmdHis')).'.'. $image->getClientOriginalExtension();                 
            }
            $upload = $image->storeAs('users', $user->image );            
            $dataUser['image'] = $user->image;
            if(!$upload){
                return redirect()->route('users.edit' , ['id'=> $id])->withErrors(['errors' =>'Erro no upload'])->withInput();
            }
        }

        $update = $user->update($dataUser);        
        
        if($update){
            return redirect()->route('users.index')->with(['success' => 'Alteração realizada com sucesso']);
        }        
        else {
            return redirect()->route('users.edit' , ['id'=> $id])->withErrors(['errors' =>'Erro no Editar'])->withInput();
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
        $user = $this->user->find($id);
        $delete = $user->delete();
        if($delete){
            return redirect()->route('users.index');
        }
        else{
            return  redirect()->route('users.show',['id' => $id])->withErrors(['errors' => 'Falha ao Deletar']);
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
        //dd($this->request);
        $dataForm = $request->except('_token');
        $users = $this->user->where('name','LIKE', "%{$dataForm['key']}%")->orWhere('email',  $dataForm['key'] )->paginate($this->totalPage);
       
        return view('admin::usuarios.index', compact('users', 'dataForm'));

    }


    
   



    
    public function perfis($id)
    {        
        $model = $this->user->find($id);
        $perfis = $model->perfis()->paginate($this->totalPage);
        $title = "Perfils do {$model->name}";
        return view("admin::usuarios.perfis", compact('model','perfis','title'));
    }



    
    public function perfisAdd($id)
    {            
        $model = $this->user->find($id);


        if(Auth::user()->hasPerfil('Admin')){
            $perfis = Perfil::whereNotIn('id', function($query) use ($id){
                        $query->select("perfils_users.perfil_id");
                        $query->from("perfils_users");
                        $query->whereRaw("perfils_users.user_id = {$id} ");
                    })->get();
            return view("admin::usuarios.perfis-add", compact('model','perfis'));
        }

        $perfis = Perfil::whereNotIn('id', function($query) use ($id){
                        $query->select("perfils_users.perfil_id");
                        $query->from("perfils_users");
                        $query->whereRaw("perfils_users.user_id = {$id} ");
                    })
                    ->where('nome', '<>' , 'Admin')->get();
        
        return view("admin::usuarios.perfis-add", compact('model','perfis'));
    }




    
    public function perfilAddUsuarios(Request $request , $id)
    {
        
        $model = $this->user->find($id);  
        foreach ($request->get('perfis') as  $value) {
            $perfil = Perfil::find($value);
            if( $perfil->nome != 'Admin' or Auth::user()->hasPerfil('Admin'))
                $model->perfis()->attach($value);
        }

        //$model->perfis()->attach($request->get('perfis'));
        return redirect()->route('users.perfis' ,$id)->with(['success' => 'Perfis vinculados com sucesso']);
    }





    
    public function deletePerfil($id,$perfilId)
    {
        
        $model = $this->user->find($id);

        $perfil = Perfil::find($perfilId);

        if( $perfil->nome == 'Admin' and ! Auth::user()->hasPerfil('Admin'))
            return redirect()->route('users.perfis' ,$id)->with(['error' => 'Perfil não pode ser Removido']);

        $model->perfis()->detach($perfilId);   

        return redirect()->route('users.perfis' ,$id)->with(['success' => 'Perfil Removido com sucesso']);
    }


}
