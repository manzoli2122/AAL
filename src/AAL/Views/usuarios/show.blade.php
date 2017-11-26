@extends('autorizacao::templates.templateAdminLateral')


@section('menuLateral')
		<div class="col-sm-3 col-md-2 menu-lateral-salao " >
            <ul class="nav nav-pills flex-column">               
				
				
                    <li class="nav-item">
                        <a class="nav-link  botao-menu-lateral" href="{{ route("autorizacao.users.perfis", $user->id) }}">                            
                            Perfis
                        </a>
                    </li>
				
                    <li class="nav-item">
                        <a class="nav-link  botao-menu-lateral" href="{{ route("users.edit", $user->id) }}">                            
                            Editar
                        </a>
                    </li>
				
            </ul>
        </div>  
@endsection





@section('content')

    <section class="row text-center conteudo-objeto">        
		<div class="col-12 col-sm-12">
            <div class="col-12 col-sm-12 conteudo">
				<h3> Usuário </h3>
			</div> 
			<div class="col-12 col-sm-12 conteudo">
				<h4> {{$user->name}} </h4>
			</div>        
			<div class="col-12 col-sm-12 conteudo">
				<h5> {{$user->email}} </h5>
			</div> 						
		</div>
    </section>

        
@endsection