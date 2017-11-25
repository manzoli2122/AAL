@extends('admin::templates.templateAdminLateral')

@section('content')


<div class="title-pg">
			<h1 class="title-pg">Gestão de Usuários</h1>
		</div>

		<div class="content-din">

            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-warning">
                    @foreach($errors->all() as $erro)
                        <p>{{$erro}}</p>
                    @endforeach
                </div>
            @endif



            @if( isset($user))
                {!! Form::model($user , ['route' => ['usuarios.update' , $user->id], 'method' => 'PUT' ,  'class' => 'form form-search form-ds', 'files' => true])!!}
            @else
                {!! Form::open(['url' => '/painel/usuarios', 'class' => 'form form-search form-ds', 'files' => true])!!}
			@endif
				<div class="form-group">
                    {!! Form::text('name' , null , ['placeholder' => 'Nome', 'class' => 'form-control'])!!}
				</div>
				<div class="form-group">
                    {!! Form::email('email' , null , ['placeholder' => 'Email', 'class' => 'form-control'])!!}
				</div>
				<div class="form-group">
                    {!! Form::password('password' , ['placeholder' => 'Senha', 'class' => 'form-control'])!!}
				</div>
				<div class="form-group">
                    {!! Form::password('password_confirmation' , ['placeholder' => 'Confirmar Senha', 'class' => 'form-control'])!!}
				</div>
				<div class="form-group">
                    {!! Form::file('image' , [ 'class' => 'form-control'])!!}
				</div>
				





				<div class="form-group">
                    {!! Form::submit('Enviar' , ['class' => 'btn btn-search']) !!}
				</div>
            {!! Form::close()!!}
			

		</div><!--Content Dinâmico-->


@endsection