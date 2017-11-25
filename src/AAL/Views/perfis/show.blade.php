@extends('autorizacao::templates.templateAdminLateral')





@section('menuLateral')
		<div class="col-sm-3 col-md-2 menu-lateral-salao " >
            <ul class="nav nav-pills flex-column">
               
				@can('usuarios-cadastrar')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("perfis.usuarios", $model->id) }}">
                            
                            Usuários
                        </a>
                    </li>
				@endcan
				@can('usuarios-apagados')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("perfis.permissoes", $model->id) }}">
                            
                            Permissões
                        </a>
                    </li>
				@endcan

                @can('usuarios-apagados')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("perfis.edit", $model->id) }}">
                            
                            Editar
                        </a>
                    </li>
				@endcan
            </ul>
        </div>  
@endsection




@section('content')
    
	<section class="row text-center placeholders">
        
		<div class="col-12 col-sm-12">
            <div class="col-12 col-sm-12 placeholder">
				<h3 style="text-align:center;"> Perfil </h3>
			</div> 

			<div class="col-12 col-sm-12 placeholder">
				<h4 style="text-align:center;"> {{$model->nome}} </h4>
			</div>        
			<div class="col-12 col-sm-12 placeholder">
				<h5 style="text-align:center;"> {{$model->descricao}} </h5>
			</div> 
						
		</div>

    </section>

@endsection