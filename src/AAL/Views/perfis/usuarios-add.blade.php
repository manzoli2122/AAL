@extends('autorizacao::templates.templateAdminLateral')

@section('content')


        <div class="title-pg">
			<h1 class="title-pg">Adicionar novo usuario ao Perfil {{$model->nome}}</h1>
		</div>

		<div class="content-din">

            



            {!! Form::open(['route' => ['perfis.usuarios.add' , $model->id], 'class' => 'form form-search form-ds', 'style="background:none;"'])!!}
    

                <div class="row">

                @foreach($users as $user)
                
                <div class="col-12 col-md-4 col-sm-4 col-xm-4">
                    <div>
                        <label>
                        {!! Form::checkbox('users[]' , $user->id )  !!}
                        {{$user->name}}
                        </label>                    
    				</div>
                </div>

                @endforeach

                </div>

				<div class=" form-group">
                <div class="col-md-12 col-sm-12 col-xm-12 ">
                    {!! Form::submit('Enviar' , ['class' => 'btn btn-search']) !!}
				</div>
                </div>
            {!! Form::close()!!}    
			

		</div><!--Content Dinâmico-->


@endsection