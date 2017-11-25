@extends('admin::templates.templateAdminLateral')

@section('content')


<div class="title-pg">
			<h1 class="title-pg">Gestão de Perfil</h1>
		</div>

		<div class="content-din">

            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-warning">
                    @foreach($errors->all() as $erro)
                        <p>{{$erro}}</p>
                    @endforeach
                </div>
            @endif



            @if( isset($model))
                {!! Form::model($model , ['route' => ['perfis.update' , $model->id], 'method' => 'PUT' ,  'class' => 'form form-search form-ds'])!!}
            @else
                {!! Form::open(['route' => 'perfis.store', 'class' => 'form form-search form-ds'])!!}
			@endif
                <div class="form-group">
                    {!! Form::text('nome' , null , ['placeholder' => 'Nome', 'class' => 'form-control'])!!}
				</div>
				<div class="form-group">
                    {!! Form::text('descricao', null, ['placeholder' => 'Descrição', 'class' => 'form-control']) !!}
                    
				</div>
				



				<div class="form-group">
                    {!! Form::submit('Enviar' , ['class' => 'btn btn-search']) !!}
				</div>
            {!! Form::close()!!}
			

		</div><!--Content Dinâmico-->


@endsection