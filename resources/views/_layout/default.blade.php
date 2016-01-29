<!DOCTYPE html>
<html>
	<head>
		@section('head')
		<meta charset="utf-8">
		<title>@yield('pagetitle')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="{{asset('css/vendor/bootstrap/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('css/flat-ui.min.css')}}" />
		<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	    <!--[if lt IE 9]>
	      <script src="{{asset('js/vendor/html5shiv.js')}}"></script>
	      <script src="{{asset('js/vendor/respond.min.js')}}"></script>
	    <![endif]-->
		@show
	</head>

	<body>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-156016-33', 'auto');
		ga('send', 'pageview');
	</script>
	<div class="container">
        @yield('header')
		@yield('content')
    </div>

	<script src="{{asset('js/vendor/jquery.min.js')}}"></script>
	@yield('pagescript')
	</body>
</html>