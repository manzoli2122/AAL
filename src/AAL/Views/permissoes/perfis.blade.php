@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )



@section( Config::get('app.templateMasterMenuLateral' , 'menuLateral')  )
	@perfil('Admin')
        <li>
			<a  href="{{route('permissoes.perfis.cadastrar', $model->id ) }}"> <i class="fa fa-circle-o text-blue">
				</i><span>Adicionar Perfil</span>                               
            </a>
        </li>
	@endperfil		
@endsection



@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
			Perfis com a Permissão {{$model->nome}}				
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
								<a href='{{route("permissoes.perfis.delete", [$model->id , $perfil->id])}}' class="delete"> <span class="glyphicon glyphicon-trash"></span> Apagar</a>                     
                            </div>
						</div>
                    </div>
                </div>
            </div>                    
    	@empty
		@endforelse  

		{!! Form::open(['route' => ['permissoes.perfis.pesquisar', $model->id ], 'class' =>  'form-inline mt-2 mt-md-0']) !!}
                    {!! Form::text('key' , null , ['class' => 'form-control' , 'placeholder' => 'Pesquisar' ]) !!}
					<button class="btn btn-outline-success my-2 my-sm-0 botao-pesquisar" type="submit">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>					
                {!!  Form::close()  !!}

@endsection






