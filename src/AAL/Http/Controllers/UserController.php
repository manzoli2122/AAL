<?php

namespace  Manzoli2122\AAL\Http\Controllers;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Manzoli2122\AAL\Models\Perfil;
use Auth;

class UserController extends Controller
{
    
    protected $totalPage = 10;

    private $user ;
    
    public function __construct(){

        $usuarioModelName = Config::get('auth.providers.users.model');
        $this->user = new $usuarioModelName();
       
        //$this->middleware('can:usuarios');
       // $this->middleware('can:usuarios_perfis')->only(['perfis' , 'perfisAdd' , 'perfilAddUsuarios' , 'deletePerfil']);
    }


    
    public function index()
    {

        $title = 'Listagem dos usuarios';
        $users = $this->user::paginate($this->totalPage);
        return view('autorizacao::usuarios.index', compact('users', 'title'));
    }

   
    
    public function show($id)
    {
        $user = $this->user->find($id);
        return view('autorizacao::usuarios.show', compact('user'));
    }

    





    public function pesquisar(Request $request)
    {
        //dd($this->request);
        $dataForm = $request->except('_token');
        $users = $this->user->where('name','LIKE', "%{$dataForm['key']}%")->orWhere('email',  $dataForm['key'] )->paginate($this->totalPage);
       
        return view('autorizacao::usuarios.index', compact('users', 'dataForm'));

    }


    
   



    
    public function perfis($id)
    {        
        $model = $this->user->find($id);
        $perfis = $model->perfis()->paginate($this->totalPage);
        $title = "Perfils do {$model->name}";
        return view("autorizacao::usuarios.perfis", compact('model','perfis','title'));
    }



    
    public function perfisAdd($id)
    {            
        $model = $this->user->find($id);


        $usuario = $this->user->find(Auth::user()->getKey());


        if($usuario->hasPerfil('Admin')){
            $perfis = Perfil::whereNotIn('id', function($query) use ($id){
                        $query->select("perfils_users.perfil_id");
                        $query->from("perfils_users");
                        $query->whereRaw("perfils_users.user_id = {$id} ");
                    })->get();
            return view("autorizacao::usuarios.perfis-add", compact('model','perfis'));
        }

        $perfis = Perfil::whereNotIn('id', function($query) use ($id){
                        $query->select("perfils_users.perfil_id");
                        $query->from("perfils_users");
                        $query->whereRaw("perfils_users.user_id = {$id} ");
                    })
                    ->where('nome', '<>' , 'Admin')->get();
        
        return view("autorizacao::usuarios.perfis-add", compact('model','perfis'));
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
        return redirect()->route('autorizacao.users.perfis' ,$id)->with(['success' => 'Perfis vinculados com sucesso']);
    }





    
    public function deletePerfil($id,$perfilId)
    {
        
        $model = $this->user->find($id);

        $perfil = Perfil::find($perfilId);

        if( $perfil->nome == 'Admin' and ! Auth::user()->hasPerfil('Admin'))
            return redirect()->route('autorizacao.users.perfis' ,$id)->with(['error' => 'Perfil não pode ser Removido']);

        $model->perfis()->detach($perfilId);   

        return redirect()->route('autorizacao.users.perfis' ,$id)->with(['success' => 'Perfil Removido com sucesso']);
    }


}
