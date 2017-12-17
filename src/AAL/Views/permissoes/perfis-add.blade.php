@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
		Adicionar novo perfil a Permissão {{$model->nome}}		
@endsection

@section( Config::get('app.templateMasterContent' , 'contentMaster')  )
    <div class="col-12 col-sm-12">
        <form method="post" action="{{route('permissoes.perfis.add',  $model->id )}}">
            {{csrf_field()}}
            <div class="row listagem-checkbox">
                @foreach($perfis as $perfil)
                <div class="col-12 col-md-4 col-sm-4 col-xm-4">
                    <div class="form-group">
                        <label> 
                            <input type="checkbox" name="perfis[]" value="{{$perfil->id}}">
                            {{$perfil->nome}}
                    </label>                    
                    </div>
                </div>
                @endforeach
            </div>
			<div class="form-group">
                <div class="col-md-12 col-sm-12 col-xm-12 ">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Salvar
                    </button>
				</div>
            </div>
        </form> 			
    </div>   
@endsection