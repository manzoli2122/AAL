<?php

namespace  Manzoli2122\AAL\Http\Controllers;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Manzoli2122\AAL\Models\Perfil;
use Auth;

use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    
    protected $totalPage = 10;

    private $user ;
    protected $perfil ;
    
    public function __construct(Perfil $perfil){

        $usuarioModelName = Config::get('auth.providers.users.model');
        $this->user = new $usuarioModelName();
        $this->perfil = $perfil;
        $this->middleware('permissao:usuarios');
        //$this->middleware('can:usuarios');
       // $this->middleware('can:usuarios_perfis')->only(['perfis' , 'perfisAdd' , 'perfilAddUsuarios' , 'deletePerfil']);
    }


    
    public function index()
    {
        $users = $this->user::paginate($this->totalPage);
        return view('autorizacao::usuarios.index', compact('users'));
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
        return view("autorizacao::usuarios.perfis", compact('model'));
    }



    
    public function perfisAdd($id)
    {    
        $model = $this->user->find($id);
        $perfis = $this->perfil->perfils_sem_usuario($id, Auth::user()->hasPerfil('Admin'));
        return view("autorizacao::usuarios.perfis-add", compact('model','perfis'));  
    }




    
    public function perfilAddUsuarios(Request $request , $id)
    {
        
        $model = $this->user->find($id);  
        foreach ($request->get('perfis') as  $value) {
            $perfil = $this->perfil->find($value);
            if( $perfil->nome != 'Admin' or Auth::user()->hasPerfil('Admin'))
                $model->attachPerfil($value);
        }
        return redirect()->route('autorizacao.users.perfis' ,$id)->with(['success' => 'Perfis vinculados com sucesso']);
    }





    
    public function deletePerfil($id,$perfilId)
    {        
        $model = $this->user->find($id);
        $perfil = $this->perfil->find($perfilId);
        if( $perfil->nome == 'Admin' and ! Auth::user()->hasPerfil('Admin'))
            return redirect()->route('autorizacao.users.perfis' ,$id)->with(['error' => 'Perfil não pode ser Removido']);
        $model->detachPerfil($perfilId);   

        return redirect()->route('autorizacao.users.perfis' ,$id)->with(['success' => 'Perfil Removido com sucesso']);
    }


}
