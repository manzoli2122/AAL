@extends( Config::get('aal.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('aal.templateMasterContentTitulo' , 'titulo-page')  )
			Listagem dos Usuários					
@endsection

	
@section( Config::get('aal.templateMasterScript' , 'script')  )
        	<script>$(function(){setTimeout("$('.hide-msg').fadeOut();",5000)});</script>
@endsection

@section( Config::get('aal.templateMasterCss' , 'css')  )					
			<style type="text/css">
					.btn-sm{
						padding: 1px 10px;
					}
					.pagination{
						margin:0px;
						display: unset;
						font-size:12px;
					}
			</style>
@endsection



@section( Config::get('aal.templateMasterContent' , 'contentMaster')  )

			<section class="row Listagens">
				<div class="col-12 col-sm-12 lista">		
					@if(Session::has('success'))
						<div class="alert alert-success hide-msg" style="float: left; width:100%; margin: 10px 0px;">
						{{Session::get('success')}}
						</div>
					@endif
				</div>
			</section>

			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">

							@if(isset($dataForm))
								{!! $users->appends($dataForm)->links() !!}
							@else
								{!! $users->links() !!}
							@endif

							{!! Form::open(['route' => 'autorizacao_users.pesquisar']) !!}
									<div class="input-group input-group-sm" style="width: 190px; margin-left:auto;">
										{!! Form::text('key' , null , ['class' => 'form-control mr-sm-2' , 'placeholder' => 'Pesquisar Usuarios' ]) !!}	
										<div class="input-group-btn">
											<button style="margin-right:10px;" class="btn btn-outline-success my-2 my-sm-0 " type="submit">
												<i class="fa fa-search" aria-hidden="true"></i>
											</button>	
										</div>
									</div>	
							{!!  Form::close()  !!}
								
						</div>
						<!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover table-striped">
								<tr>
									<th>Nome</th>
									<th>E-mail</th>					
									<th>Ações</th>
								</tr>
								@forelse($users as $user)				
									<tr>
										<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>														
										<td>											
											<a class="btn btn-success" href="{{ route('autorizacao_users.perfis', $user->id) }}">                            
												Perfis
											</a>                   
										</td>
									</tr>
								@empty
									
								@endforelse
							</table>
					</div>


					
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
				</div>
			</div>

@endsection