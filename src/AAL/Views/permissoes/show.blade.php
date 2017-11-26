@extends('autorizacao::templates.templateAdminLateral')



@section('menuLateral')
		<div class="col-sm-3 col-md-2 menu-lateral-salao " >
            <ul class="nav nav-pills flex-column">             
								
                    <li class="nav-item">
                        <a class="nav-link  botao-menu-lateral" href="{{ route("permissoes.perfis", $model->id) }}">                            
                            <b>Perfis</b>
                        </a>
                    </li>
				
                    <li class="nav-item">
                        <a class="nav-link  botao-menu-lateral" href="{{ route("permissoes.edit", $model->id) }}">                            
                            <b>Editar</b>
                        </a>
                    </li>
				
            </ul>
        </div>  
@endsection




@section('content')
    
	<section class="row text-center placeholders">
        
		<div class="col-12 col-sm-12">
            <div class="col-12 col-sm-12 placeholder">
				<h3 style="text-align:center;"> Permissão </h3>
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