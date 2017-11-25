@extends('admin::templates.templateAdminLateral')

@section('content')


        <div class="title-pg">
			<h3 class="title-pg">Adicionar novo perfil a Permissão {{$model->nome}}</h3>
		</div>

		<div class="content-din">

            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-warning">
                    @foreach($errors->all() as $erro)
                        <p>{{$erro}}</p>
                    @endforeach
                </div>
            @endif



            {!! Form::open(['route' => ['permissoes.perfis.add' , $model->id], 'class' => 'form form-search form-ds' , 'style="background:none;"'])!!}
    
            <div class="row">
                @foreach($perfis as $perfil)
                <div class="col-12 col-md-4 col-sm-4 col-xm-4">
                <div class="form-group">
                    <label>
                    {!! Form::checkbox('perfis[]' , $perfil->id )  !!}
                    {{$perfil->nome}}
                    </label>                    
				</div></div>
                @endforeach
            </div>
				<div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xm-12 ">
                    {!! Form::submit('Enviar' , ['class' => 'btn btn-search']) !!}
				</div></div>
            {!! Form::close()!!}    
			

		</div><!--Content Dinâmico-->


@endsection