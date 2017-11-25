@extends('autorizacao::templates.templateAdminLateral')


@section('pesquisar')				
	{!! Form::open(['route' => 'permissoes.pesquisar', 'class' =>  'form-inline mt-2 mt-md-0']) !!}
        {!! Form::text('key' , null , ['class' => 'form-control mr-sm-2' , 'placeholder' => 'Pesquisar Permissões' , 'aria-label' => 'Search']) !!}		
		<button style="margin-right:10px;" class="btn btn-outline-success my-2 my-sm-0 " type="submit">
			<i class="fa fa-search" aria-hidden="true"></i>
		</button>		
    {!!  Form::close()  !!}
@endsection


@section('menuLateral')
		<div class="col-sm-3 col-md-2 menu-lateral-salao " >
            <ul class="nav nav-pills flex-column">
               

				
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('permissoes.create') }}">
                            
                            Cadastrar Novo Permissão
                        </a>
                    </li>
				
				
            </ul>
        </div>  
@endsection



@section('content')


<div class="title-pg">
			<h1 class="title-pg">Listagem das Permissões </h1>
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
					<th>Descrição</th>
					
				</tr>

				@forelse($models as $model)
					<tr>
						<td><a href='{{route("permissoes.show", $model->id)}}' class="delete"> <span class="glyphicon glyphicon-eye-open"></span> {{$model->nome}}</a>
						</td>
						<td>{{$model->descricao}}</td>
						
					</tr>
				@empty
                   
                @endforelse
			</table>
			@if(isset($dataForm))
				{!! $models->appends($dataForm)->links() !!}
			@else
				{!! $models->links() !!}
			@endif
		</div><!--Content Dinâmico-->


@endsection