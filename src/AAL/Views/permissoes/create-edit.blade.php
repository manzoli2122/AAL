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
			<h5>Cadastrar / Editar Permissão</h5>
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
            @if( isset($model))
                {!! Form::model($model , ['route' => ['permissoes.update' , $model->id], 'method' => 'PUT' ,  'class' => 'form form-search form-ds'])!!}
            @else
                {!! Form::open(['route' => 'permissoes.store', 'class' => 'form form-search form-ds'])!!}
			@endif
                    <div class="form-group row">
                        <label for="nome" class="col-form-label col-12 col-sm-3">Nome:</label>
                        {!! Form::text('nome' , null , ['placeholder' => 'Nome', 'class' => 'form-control col-12 col-sm-9'])!!}
                    </div>
                    <div class="form-group row">
                        <label for="descricao" class="col-form-label col-12 col-sm-3">Descrição:</label>
                        {!! Form::text('descricao', null, ['placeholder' => 'Descrição', 'class' => 'form-control col-12 col-sm-9']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Enviar' , ['class' => 'btn btn-danger']) !!}
                    </div>
                {!! Form::close()!!}
        </div>   
        <div class="col-1 col-sm-1 placeholder"></div>     
    </section>


@endsection