@extends('autorizacao::templates.templateAdminLateral')




@section('pesquisar')
	
				{!! Form::open(['route' => ['permissoes.perfis.pesquisar', $model->id ], 'class' =>  'form form-inline', 'style' => 'display: inline;']) !!}
                    {!! Form::text('key' , null , ['class' => 'form-control' , 'placeholder' => 'Nome' , 'style' => 'min-width: 400px;']) !!}
					<button style="margin-right:10px;" class="btn btn-outline-success my-2 my-sm-0 " type="submit">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>					
                {!!  Form::close()  !!}	
	
@endsection






@section('menuLateral')
		<div class="col-sm-3 col-md-2 menu-lateral-salao " >
            <ul class="nav nav-pills flex-column">
               

				
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('permissoes.perfis.cadastrar', $model->id ) }}">
                            
                            Adicionar Perfil
                        </a>
                    </li>
				
				
            </ul>
        </div>  
@endsection










@section('content')


	<div class="title-pg text-center">
			<h3 class="title-pg">Perfis da Permissão {{$model->nome}}</h3>
		</div>

		<div class="content-din bg-white">

					

			@if(Session::has('success'))
				<div class="alert alert-success hide-msg" style="float: left; width:100%; margin: 10px 0px;">
				{{Session::get('success')}}
				</div>
			@endif
			
			<table class="table table-striped table-sm">
				<tr>
					<th>Nome</th>
					<th>Ações</th>
					
				</tr>

				@forelse($perfis as $perfil)
					<tr>
						<td>{{$perfil->nome}}</td>
						
						<td>
							<a href='{{route("permissoes.perfis.delete", [$model->id , $perfil->id])}}' class="delete"> <span class="glyphicon glyphicon-trash"></span> Deletar</a>
						</td>
					</tr>
				@empty
                   
                @endforelse
			</table>
			@if(isset($dataForm))
				{!! $perfis->appends($dataForm)->links() !!}
			@else
				{!! $perfis->links() !!}
			@endif
		</div><!--Content Dinâmico-->


@endsection