@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('app.templateMasterMenuLateral' , 'menuLateral')  )			
	@perfil('Admin')
	<li>
		<a href="{{route('autorizacao_users.perfis.cadastrar', $model->id ) }}"><i class="fa fa-circle-o text-blue">
			</i><span>Adicionar Permissão</span>
		</a>
	</li>	
	@endperfil				
@endsection



@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
			Perfils do {{$model->name}}				
@endsection




@section( Config::get('app.templateMasterContent' , 'contentMaster')  )
 
		@forelse($model->perfis as $perfil)
                      
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$perfil->nome}}</h3>                                                          
                	</div>                        
                    <div class="box-body">                               
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix">
								<a href='{{route("autorizacao_users.perfis.delete", [$model->id , $perfil->id])}}' class="btn btn-danger btn-sm"> Apagar</a>                               
                            </div>
						</div>
                    </div>
                </div>
            </div>                    
    	@empty
		@endforelse  

@endsection