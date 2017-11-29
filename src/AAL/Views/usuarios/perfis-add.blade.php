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
			<h5>Adicionar novo Perfil ao usuario {{$model->name}}</h5>
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

            {!! Form::open(['route' => ['autorizacao_users.perfis.add' , $model->id], 'class' => 'form form-search form-ds'])!!}
                <div class="row listagem-checkbox">
                    @foreach($perfis as $perfil)
                        
                        <div class="col-md-3 col-sm-4 col-xm-12">
                            <div class="form-group">
                                <label>{!! Form::checkbox('perfis[]' , $perfil->id )  !!}{{$perfil->nome}}</label>                    
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
			
        </div>   
        <div class="col-1 col-sm-1 placeholder"></div>     
    </section>
@endsection