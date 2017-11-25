@extends('autorizacao::templates.templateAdmin')

	@section('contentMaster') 

        <div class="container-fluid">
            <div class="row">

                @yield('menuLateral')

                <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                        @yield('content')	
                </main>            

            </div>
            
        </div>

	@endsection