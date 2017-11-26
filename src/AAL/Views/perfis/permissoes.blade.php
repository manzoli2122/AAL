@extends('autorizacao::templates.templateAdminLateral')




@section('pesquisar')	
	{!! Form::open(['route' => ['perfis.permissoes.pesquisar', $model->id ], 'class' =>  'form-inline mt-2 mt-md-0']) !!}
        {!! Form::text('key' , null , ['class' => 'form-control' , 'placeholder' => 'Pesquisar' ]) !!}
		<button class="btn btn-outline-success my-2 my-sm-0 botao-pesquisar" type="submit">
			<i class="fa fa-search" aria-hidden="true"></i>
		</button>					
    {!!  Form::close()  !!}		
@endsection


@section('menuLateral')
		<div class="col-sm-3 col-md-2 menu-lateral-salao " >
            <ul class="nav nav-pills flex-column">

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('perfis.permissoes.cadastrar', $model->id ) }}">                            
                            Adicionar Permissão
                        </a>
                    </li>				
				
            </ul>
        </div>  
@endsection


















@section('content')


<div class="title-pg">
			<h3 class="title-pg  text-center">Permissoes do Perfil {{$model->nome}}</h3>
		</div>

		<div class="content-din bg-white">


			
			@if(Session::has('success'))
				<div class="alert alert-success hide-msg" style="float: left; width:100%; margin: 10px 0px;">
				{{Session::get('success')}}
				</div>
			@endif
			
			<table class="table table-striped table-sm">
				<tr>
					<th>Nome</th>
					<th width="200">Ações</th>					
				</tr>

				@forelse($permissoes as $permissao)
					<tr>
						<td>{{$permissao->nome}}</td>						
						<td>
							<a href='{{route("perfis.permissoes.delete", [$model->id , $permissao->id])}}' class="delete"> <span class="glyphicon glyphicon-trash"></span> Deletar</a>
						</td>
					</tr>
				@empty
                   
                @endforelse
			</table>
			@if(isset($dataForm))
				{!! $permissoes->appends($dataForm)->links() !!}
			@else
				{!! $permissoes->links() !!}
			@endif
		</div><!--Content Dinâmico-->


@endsection