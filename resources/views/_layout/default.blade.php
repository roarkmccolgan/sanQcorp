<!DOCTYPE html>
<html>
	<head>
		@section('head')
		<meta charset="utf-8">
		<title>@yield('pagetitle')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telephone=no">
		<meta id="token" name="token" value="{{ csrf_token() }}">
		<link rel="stylesheet" href="{{asset('css/vendor/bootstrap/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('css/flat-ui-pro.min.css')}}" />
		<link rel="stylesheet" href="{{asset('css/vendor/select2/select2.min.css')}}" />
		<link rel="stylesheet" href="{{asset('js/vendor/summernote/summernote.css')}}" />
		<link rel="stylesheet" href="{{asset('css/vendor/literallycanvas/literallycanvas.css')}}" />
		<link rel="stylesheet" href="{{asset('css/vendor/sweetalert2/sweetalert2.min.css')}}" />
		<link rel="stylesheet" href="{{elixir('css/main.css')}}" />
		<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	    <!--[if lt IE 9]>
	      <script src="{{asset('js/vendor/html5shiv.js')}}"></script>
	      <script src="{{asset('js/vendor/respond.min.js')}}"></script>
	    <![endif]-->
		@show
	</head>

	<body>
		@yield('afterbody')
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-156016-33', 'auto');
			ga('send', 'pageview');
		</script>
		<nav class="navbar navbar-default">
	        <div class="container">
	            <div class="navbar-header">

	                <!-- Collapsed Hamburger -->
	                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
	                    <span class="sr-only">Toggle Navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>

	                <!-- Branding Image -->
	                <a class="navbar-brand" href="{{ url('/') }}">
	                    sanQCorp
	                </a>
	            </div>

	            <div class="collapse navbar-collapse" id="app-navbar-collapse">
	                <!-- Left Side Of Navbar -->
	                @include('_layout.menu.main')
	                

	                <!-- Right Side Of Navbar -->
	                <ul class="nav navbar-nav navbar-right">
	                    <!-- Authentication Links -->
	                    @if (Auth::guest())
	                    	<li class="dropdown {{ Ekko::areActiveURLs(['/jobs','/jobs/new']) }}">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									Admin <span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li class="{{ Ekko::isActiveURL('/jobs') }}"><a href="{{ url('/jobs') }}"><i class="fa fa-btn fa-sign-out"></i>Jobs</a></li>
									<li class="{{ Ekko::isActiveURL('/jobs/new') }}"><a href="{{ url('/jobs/new') }}"><i class="fa fa-btn fa-sign-out"></i>New Job</a></li>
								</ul>
							</li>
	                        <li><a href="{{ url('/login') }}">Login</a></li>
	                        <li><a href="{{ url('/register') }}">Register</a></li>
	                    @else
	                        <li class="dropdown">
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
	                                {{ Auth::user()->name }} <span class="caret"></span>
	                            </a>

	                            <ul class="dropdown-menu" role="menu">
	                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
	                            </ul>
	                        </li>
	                    @endif
	                </ul>
	            </div>
	        </div>
	    </nav>
	    @if(isset($vueView))
		<component is="{{$vueView}}" inline-template>
		@endif
			<div class="container">
				@yield('header')
				@yield('content')
			</div>			
		@if(isset($vueView))
		</component>
		@endif

		<script src="{{asset('js/vendor/jquery.min.js')}}"></script>
		<script src="{{asset('js/flat-ui-pro.js')}}"></script>
		@yield('pagescript')
		<script src="{{elixir('js/main.js')}}"></script>
		
		
	</body>
</html>