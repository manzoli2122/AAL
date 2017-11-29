@extends('autorizacao::templates.templateAdminLateral')


@section('menuLateral')
		<div class="col-sm-3 col-md-2 menu-lateral-salao " >
            <ul class="nav nav-pills flex-column">
            </ul>
        </div>  
@endsection


@section('content')

    <section class="row text-center  titulo-pagina">
        <div class="col-12 col-sm-12 titulo">
			<h5>Cadastrar / Editar Usuários</h5>
        </div>        
    </section>


    <section class="row text-center errors">
        <div class="col-12 col-sm-12 error">
            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-warning">
                    @foreach($errors->all() as $erro)
                        <p>{{$erro}}</p>
                    @endforeach
                </div>
            @endif
        </div>        
    </section>

    <section class="row text-center formulario">
        
        <div class="col-11 col-sm-11">

            @if( isset($user))
                {!! Form::model($user , ['route' => ['autorizacao_users.update' , $user->id], 'method' => 'PUT' ,  'class' => 'form form-search form-ds', 'files' => true])!!}
            @else
                {!! Form::open(['route' => 'autorizacao_users.store', 'class' => 'form form-search form-ds', 'files' => true])!!}
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
			

		</div>   
        <div class="col-1 col-sm-1 placeholder"></div>     
    </section>

@endsection