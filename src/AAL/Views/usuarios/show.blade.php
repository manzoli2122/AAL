@extends('admin::templates.templateAdminLateral')


@section('menuLateral')
		<div class="col-sm-3 col-md-2 menu-lateral-salao " >
            <ul class="nav nav-pills flex-column">
               
				
				@can('usuarios-apagados')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("users.perfis", $user->id) }}">                            
                            Perfis
                        </a>
                    </li>
				@endcan

                @can('usuarios-apagados')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("users.edit", $user->id) }}">                            
                            Editar
                        </a>
                    </li>
				@endcan
            </ul>
        </div>  
@endsection





@section('content')


<div class="title-pg">
			<h1 class="title-pg">Usuários {{$user->name}}</h1>
		</div>

		<div class="content-din">

            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-warning">
                    @foreach($errors->all() as $erro)
                        <p>{{$erro}}</p>
                    @endforeach
                </div>
            @endif

            <h2><strong>Nome:</strong> {{$user->name}}</h2>
            <h2><strong>Email:</strong> {{$user->email}}</h2>
            <h2><strong>Imagem:</strong> {{$user->image}}</h2>

            
           
            {!! Form::open(['route' => ['users.destroy', $user->id ],  'method' => 'DELETE' , 'class' => 'form form-search form-ds'])!!}
		
				
                <div class="form-group">
                    {!! Form::submit('Deletar Usuario' , ['class' => 'btn btn-danger']) !!}
				</div>
                
            {!! Form::close()!!}
			

		</div><!--Content Dinâmico-->


@endsection