@extends('admin::templates.templateAdminLateral')



@section('pesquisar')				
	{!! Form::open(['route' => 'users.pesquisar', 'class' =>  'form-inline mt-2 mt-md-0']) !!}
        {!! Form::text('key' , null , ['class' => 'form-control mr-sm-2' , 'placeholder' => 'Pesquisar Usuarios' , 'aria-label' => 'Search']) !!}		
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
                        <a class="nav-link" href="{{ route('users.create') }}">
                            
                            Cadastrar Novo Usuario
                        </a>
                    </li>
				@endcan
				
            </ul>
        </div>  
@endsection



@section('content')


		<div class="title-pg">
			<h3 class="title-pg">Listagem dos Usuários</h3>
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
					<th>E-mail</th>
					
				</tr>

				@forelse($users as $user)
					<tr>
						<td><a href='{{route("users.show", $user->id)}}' class="delete"> <span class="glyphicon glyphicon-eye-open"></span> {{$user->name}}</a>
						</td>
						<td>{{$user->email}}</td>
						
					</tr>
				@empty
                    vazio
                @endforelse
			</table>
			@if(isset($dataForm))
				{!! $users->appends($dataForm)->links() !!}
			@else
				{!! $users->links() !!}
			@endif
		</div><!--Content Dinâmico-->


@endsection