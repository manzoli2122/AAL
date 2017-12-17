@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterMenuLateral' , 'menuLateral')  )
	@perfil('Admin')		
		<li>
			<a href="{{route('perfis.permissoes.cadastrar', $model->id ) }}"><i class="fa fa-circle-o text-blue">
				</i><span> Adicionar Permissão</span>
			</a>
		</li>
	@endperfil				
@endsection

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
			Permissoes do Perfil {{$model->nome}}			
@endsection


@section( Config::get('app.templateMasterContentTituloSmall' , 'titulo-page')  )
          {!! Form::open(['route' => ['perfis.permissoes.pesquisar', $model->id ], 'class' =>  'form-inline mt-2 mt-md-0']) !!}
			{!! Form::text('key' , null , ['class' => 'form-control' , 'placeholder' => 'Pesquisar' ]) !!}
			<button class="btn btn-outline-success my-2 my-sm-0 botao-pesquisar" type="submit">
				<i class="fa fa-search" aria-hidden="true"></i>
			</button>					
		{!!  Form::close()  !!}	         
@endsection




@section( Config::get('app.templateMasterContent' , 'contentMaster')  )
 
		 @if(!isset($permissoes))
		    <?php $permissoes = $model->permissoes; ?>
        @endif

		@forelse($permissoes as $permissao)
                      
            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$permissao->nome}}</h3>                                                          
                	</div>                        
                    <div class="box-body">                               
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix">
								<a href='{{route("perfis.permissoes.delete", [$model->id , $permissao->id])}}' class="btn btn-danger btn-sm"> <span class="glyphicon glyphicon-trash"></span> Deletar</a>                   
                            </div>
						</div>
                    </div>
                </div>
            </div>                    
    	@empty
		@endforelse  

		

@endsection

