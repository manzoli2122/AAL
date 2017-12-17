@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
		Adicionar novo perfil a Permissão {{$model->nome}}		
@endsection

@section( Config::get('app.templateMasterContent' , 'contentMaster')  )
        
        <div class="col-11 col-sm-11">
            
            {!! Form::open(['route' => ['permissoes.perfis.add' , $model->id], 'class' => 'form form-search form-ds' ])!!}
    
                <div class="row listagem-checkbox">
                    @foreach($perfis as $perfil)
                        <div class="col-12 col-md-4 col-sm-4 col-xm-4">
                            <div class="form-group">
                                <label>{!! Form::checkbox('perfis[]' , $perfil->id )  !!} {{$perfil->nome}}</label>                    
				            </div>
                        </div>
                    @endforeach
                </div>
				<div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xm-12 ">
                        {!! Form::submit('Enviar' , ['class' => 'btn btn-danger']) !!}
				    </div>
                </div>
            {!! Form::close()!!}    
			
        </div>   
        <div class="col-1 col-sm-1 placeholder"></div>  

@endsection