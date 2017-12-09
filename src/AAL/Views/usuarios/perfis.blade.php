@extends( Config::get('aal.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('aal.templateMasterMenuLateral' , 'menuLateral')  )
			
					<li>
						<a href="{{route('autorizacao_users.perfis.cadastrar', $model->id ) }}"><i class="fa fa-circle-o text-blue">
							</i><span>Adicionar Permissão</span>
						</a>
					</li>				
@endsection



@section( Config::get('aal.templateMasterContentTitulo' , 'titulo-page')  )
			Perfils do {{$model->name}}				
@endsection





@section('pesquisar')
	{!! Form::open(['route' => ['autorizacao_users.perfis.pesquisar', $model->id ], 'class' =>  'form-inline mt-2 mt-md-0']) !!}
        {!! Form::text('key' , null , ['class' => 'form-control' , 'placeholder' => 'Nome' , 'style' => 'min-width: 400px;']) !!}
		<button class="btn btn-outline-success my-2 my-sm-0 botao-pesquisar" type="submit">
			<i class="fa fa-search" aria-hidden="true"></i>
		</button>					
    {!!  Form::close()  !!}		
@endsection




@section( Config::get('aal.templateMasterContent' , 'contentMaster')  )

	


	
	<section class="row  Listagens">
        <div class="col-12 col-sm-12 lista">		
			@if(Session::has('success'))
				<div class="alert alert-success hide-msg" style="float: left; width:100%; margin: 10px 0px;">
				{{Session::get('success')}}
				</div>
			@endif	
			
			<table class="table table-bordered  table-striped table-sm">
				<tr class="thead-dark">
					<th>Nome</th>
					<th>Ações</th>					
				</tr>

				@forelse($model->perfis as $perfil)
					<tr>
						<td>{{$perfil->nome}}</td>						
						<td>
							<a href='{{route("autorizacao_users.perfis.delete", [$model->id , $perfil->id])}}' class="btn btn-danger btn-sm"> Deletar</a>
						</td>
					</tr>
				@empty                   
                @endforelse
			</table>
		</div>       
    </section>

@endsection