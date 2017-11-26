@extends('autorizacao::templates.templateAdminLateral')



@section('menuLateral')
		<div class="col-sm-3 col-md-2 menu-lateral-salao " >
            <ul class="nav nav-pills flex-column">               
				
                    <li class="nav-item">
                        <a class="nav-link  botao-menu-lateral" href="{{ route("perfis.usuarios", $model->id) }}">                            
                            Usuários
                        </a>
                    </li>
				
                    <li class="nav-item">
                        <a class="nav-link botao-menu-lateral" href="{{ route("perfis.permissoes", $model->id) }}">                            
                            Permissões
                        </a>
                    </li>
				
                    <li class="nav-item">
                        <a class="nav-link botao-menu-lateral" href="{{ route("perfis.edit", $model->id) }}">                            
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
				<h3 style="text-align:center;"> Perfil </h3>
			</div> 

			<div class="col-12 col-sm-12 conteudo">
				<h4 style="text-align:center;"> {{$model->nome}} </h4>
			</div>        
			<div class="col-12 col-sm-12 conteudo">
				<h5 style="text-align:center;"> {{$model->descricao}} </h5>
			</div> 
						
		</div>

    </section>

@endsection