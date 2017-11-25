@extends('autorizacao::templates.templateAdminLateral')




@section('pesquisar')
	
				{!! Form::open(['route' => ['perfis.usuarios.pesquisar', $model->id ], 'class' =>  'form form-inline', 'style' => 'display: inline;']) !!}
                    {!! Form::text('key' , null , ['class' => 'form-control' , 'placeholder' => 'Nome' , 'style' => 'min-width: 400px;']) !!}
					<button style="margin-right:10px;" class="btn btn-outline-success my-2 my-sm-0 " type="submit">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>					
                {!!  Form::close()  !!}	
	
@endsection





@section('menuLateral')
		<div class="col-sm-3 col-md-2 menu-lateral-salao " >
            <ul class="nav nav-pills flex-column">
               

				@can('usuarios-cadastrar')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('perfis.usuarios.cadastrar', $model->id ) }}">
                            
                            Adicionar Usuário
                        </a>
                    </li>
				@endcan
				
            </ul>
        </div>  
@endsection





@section('content')


<div class="title-pg">
			<h3 class="title-pg text-center">Usuarios do Perfil {{$model->nome}}</h3>
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

				@forelse($users as $user)
					<tr>
						<td>{{$user->name}}</td>
						
						<td>
							<a href='{{route("perfis.usuarios.delete", [$model->id , $user->id])}}' class="delete"> <span class="glyphicon glyphicon-trash"></span> Deletar</a>
						</td>
					</tr>
				@empty
                   
                @endforelse
			</table>
			@if(isset($dataForm))
				{!! $users->appends($dataForm)->links() !!}
			@else
				{!! $users->links() !!}
			@endif
		</div><!--Content Dinâmico-->


@endsection