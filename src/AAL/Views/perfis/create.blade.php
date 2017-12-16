
@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )			
		Cadastrar Perfil
@endsection    

@section( Config::get('app.templateMasterContent' , 'content')  )


<div class="col-md-12">
    <div class="box box-success">

        <form method="post" action="{{route('perfis.store')}}">
            
            {{csrf_field()}}


            <div class="box-body">	
                <div class="row">
                    
                    <div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome do Perfil"
                            value="{{old('nome')}}">
                        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('descricao') ? 'has-error' : ''}}">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control" name="descricao" placeholder="Descrição do Perfil"
                            value="{{old('descricao')}}">
                        {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
                    </div>

                </div>
            </div>

            <div class="box-footer align-right">
                <a class="btn btn-default" href="{{ URL::previous() }}">
                    <i class="fa fa-reply"></i> Cancelar
                </a>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Salvar
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
