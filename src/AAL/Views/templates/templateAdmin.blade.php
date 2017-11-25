<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>{{$title or 'Admin' }}</title>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="{{ url('vendor/autorizacao/bootstrap/css/bootstrap.min.css')}} ">		
		<!--Fonts-->
		<link rel="stylesheet" href="{{ url('vendor/autorizacao/css/font-awesome.min.css')}} ">
		
		
		@stack('head-scripts')		
		<!--Favicon-->
		<link rel="icon" type="image/png" href="{{ url('vendor/autorizacao/imgs/favicon.png')}}">
	</head>
<body>

	<header>
      	<nav class="navbar navbar-expand-lg navbar-dark fixed-top " style="background-color: #d81c1e;">
        	<a class="navbar-brand" href="{{ url('/painel')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
			
        	<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          		<span class="navbar-toggler-icon"></span>
        	</button>
			
        	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
          		<ul class="navbar-nav mr-auto">
					@can('usuarios')
						<li class="nav-item ">
							<a class="nav-link active" href="{{ route('users.index') }}"> <span class="sr-only">(current)</span>
								<i class="fa fa-id-card" aria-hidden="true"></i>
								Usuários
							</a>
						</li>
					@endcan

					@can('perfis')
						<li class="nav-item ">
							<a class="nav-link active" href="{{ route('perfis.index')}}"> <span class="sr-only">(current)</span>
								<i class="fa fa-id-card" aria-hidden="true"></i>
								Perfil
							</a>
						</li>					
					@endcan

					@can('permissoes')
						<li class="nav-item ">
							<a class="nav-link active" href="{{ route('permissoes.index')}}"> <span class="sr-only">(current)</span>
								<i class="fa fa-id-card" aria-hidden="true"></i>
								Permissões
							</a>
						</li>					
					@endcan

				</ul>	


				@yield('pesquisar')
				

				<ul class="navbar-nav pull-rigth" style="margin-right:40px">
					
					
					<li class="nav-item dropdown active">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						{{auth()->user()->apelido}}
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								Logout
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
							
							
						</div>
					</li>

					
					
												
				</ul>
        </div>
      </nav>
    </header>

    @yield('contentMaster')

	<!--jQuery-->
	<script src="{{ url('vendor/autorizacao/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{ url('vendor/autorizacao/js/popper.js')}}"></script>
	<script>$(function(){setTimeout("$('.hide-msg').fadeOut();",5000)});</script>
	<!-- jS Bootstrap -->
	<script src="{{ url('vendor/autorizacao/bootstrap/js/bootstrap.min.js')}}"></script>
	@stack('scripts')
</body>
</html>