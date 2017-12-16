@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
	Listagem das Permissões			
@endsection

@section( Config::get('app.templateMasterContent' , 'content')  )

<div class="col-xs-12">
    <div class="box box-success">
		@perfil('Admin')
        	<div class="box-header align-right">	
				<a  href="{{ route('permissoes.create') }}" class="btn btn-success" title="Adicionar um novo Perfil"> 
					<i class="fa fa-plus"></i>Cadastrar Nova Permissão                               
                </a>                    		           
        	</div>
		@endperfil 

        <div class="box-body">
            <table class="table table-bordered table-striped table-hover" id="datatable">
                <thead>
                    <tr>
						<th pesquisavel>ID</th>
						<th pesquisavel>Nome</th>						
						<th>Descrição</th>						
                        <th class="align-center" style="width:100px">Ações</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection


@push(Config::get('app.templateMasterScript' , 'script') )
	<script src="{{ mix('js/datatables-padrao.js') }}" type="text/javascript"></script>

	<script>
		$(document).ready(function() {
			var dataTable = datatablePadrao('#datatable', {
				order: [[ 0, "asc" ]],
				ajax: { 
					url:'{{ route('permissoes.getDatatable') }}'
				},
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'nome', name: 'nome' },
					{ data: 'descricao', name: 'descricao' },					
					{ data: 'action', name: 'action', orderable: false, searchable: false, class: 'align-center'}
				],
			});

			dataTable.on('draw', function () {
				$('[btn-excluir]').click(function (){
					excluirRecursoPeloId($(this).data('id'), "@lang('msg.conf_excluir_o', ['1' => 'permissoes'])", "{{ route('permissoes.index') }}", 
						function(){
							dataTable.row( $(this).parents('tr') ).remove().draw('page');
						}
					);
				});
			});
		});
	</script>
@endpush


