@extends('autorizacao::templates.templateAdminLateral')



@section('pesquisar')				
	{!! Form::open(['route' => 'autorizacao.users.pesquisar', 'class' =>  'form-inline mt-2 mt-md-0']) !!}
        {!! Form::text('key' , null , ['class' => 'form-control mr-sm-2' , 'placeholder' => 'Pesquisar Usuarios' ]) !!}		
		<button  class="btn btn-outline-success my-2 my-sm-0 botao-pesquisar" type="submit">
			<i class="fa fa-search" aria-hidden="true"></i>
		</button>		
    {!!  Form::close()  !!}
@endsection


@section('menuLateral')
		<div class="col-sm-3 col-md-2 menu-lateral-salao " >
            <ul class="nav nav-pills flex-column">
               
                    <li class="nav-item">
                        <a class="nav-link botao-menu-lateral" href="{{ route('users.create') }}">                            
                            Cadastrar Usuario
                        </a>
                    </li>
				
            </ul>
        </div>  
@endsection



@section('content')

	<section class="row text-center titulo-pagina">
        <div class="col-12 col-sm-12 titulo">
			<h5>Listagem dos Usuários</h5>
        </div>        
    </section>

	<section class="row text-center Listagens">
        <div class="col-12 col-sm-12 lista">		
			@if(Session::has('success'))
				<div class="alert alert-success hide-msg" style="float: left; width:100%; margin: 10px 0px;">
				{{Session::get('success')}}
				</div>
			@endif	

			<table class="table table-bordered  table-striped table-sm">
				<tr class="thead-dark">
					<th>Nome</th>
					<th>E-mail</th>					
				</tr>
				@forelse($users as $user)
					<tr>
						<td><a href='{{route("users.show", $user->id)}}' class="delete"> <span class="glyphicon glyphicon-eye-open"></span> {{$user->name}}</a>
						</td>
						<td>{{$user->email}}</td>						
					</tr>
				@empty
                @endforelse
			</table>
		</div>
        <div class="col-12 col-sm-12 paginacao">
			@if(isset($dataForm))
				{!! $models->appends($dataForm)->links() !!}
			@else
				{!! $models->links() !!}
			@endif
        </div>
    </section>
@endsection