@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
			Adicionar novo Permissao ao Perfil {{$model->nome}}				
@endsection

@section( Config::get('app.templateMasterContent' , 'contentMaster')  )
    <div class="col-12 col-sm-12">
        <form method="post" action="{{route('perfis.permissoes.add',  $model->id )}}">
            {{csrf_field()}}
            <div class="row listagem-checkbox">
                @foreach($permissoes as $permissao)
                <div class="col-12 col-md-4 col-sm-4 col-xm-4">
                    <div class="form-group">
                        <label> 
                            <input type="checkbox" name="permissoes[]" value="{{$permissao->id}}">
                            {{$permissao->nome}}
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