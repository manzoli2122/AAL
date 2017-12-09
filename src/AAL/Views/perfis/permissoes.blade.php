@extends( Config::get('aal.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('aal.templateMasterMenuLateral' , 'menuLateral')  )
			
					<li>
						<a href="{{route('perfis.permissoes.cadastrar', $model->id ) }}"><i class="fa fa-circle-o text-blue">
							</i><span> Adicionar Permissão</span>
						</a>
					</li>				
@endsection



@section( Config::get('aal.templateMasterContentTitulo' , 'titulo-page')  )
			Permissoes do Perfil {{$model->nome}}			
@endsection



@section('pesquisar')	
	{!! Form::open(['route' => ['perfis.permissoes.pesquisar', $model->id ], 'class' =>  'form-inline mt-2 mt-md-0']) !!}
        {!! Form::text('key' , null , ['class' => 'form-control' , 'placeholder' => 'Pesquisar' ]) !!}
		<button class="btn btn-outline-success my-2 my-sm-0 botao-pesquisar" type="submit">
			<i class="fa fa-search" aria-hidden="true"></i>
		</button>					
    {!!  Form::close()  !!}		
@endsection



@section( Config::get('aal.templateMasterContent' , 'contentMaster')  )

	

	
	<section class="row text-center Listagens">
        <div class="col-12 col-sm-12 lista">		
			@if(Session::has('success'))
				<div class="alert alert-success hide-msg" style="float: left; width:100%; margin: 10px 0px;">
				{{Session::get('success')}}
				</div>
			@endif	
			
			
			<table class="table table-bordered  table-striped table-sm">
				<tr class="thead-dark">
					<th>Nome</th>
					<th width="200">Ações</th>					
				</tr>

				@forelse($model->permissoes as $permissao)
					<tr>
						<td>{{$permissao->nome}}</td>						
						<td>
							<a href='{{route("perfis.permissoes.delete", [$model->id , $permissao->id])}}' class="delete"> <span class="glyphicon glyphicon-trash"></span> Deletar</a>
						</td>
					</tr>
				@empty                   
                @endforelse
			</table>
		
		 </div>       
    </section>

@endsection