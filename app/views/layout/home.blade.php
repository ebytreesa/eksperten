<!doctype html>
<html lang="da">
<head>
<meta charset="utf-8">
<title>@yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">

<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
 
</head>
<style type="text/css">
	body{

	}
	nav{
		margin-top: 50px;
		background-color:#6aa1b7;
		color: black;
	}
	nav a{ color: black; }
	.icon-bar { background-color:black; }

	h4{ color:red; }
</style>
		
<body>
<div class="pull-right" style="padding:10px ;margin-bottom: 20px; ">
@if (Auth::check())
 welcome <strong style="color:red;">{{ Auth::user()->username }}</strong><br>
 <strong style="color:red;">points:{{ Auth::user()->points}}</strong>
@endif
</div>
	<div class="container-fluid">
		@if ( Session::has('success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{ Session::get('success') }}
		</div>
		@endif
		@if ( Session::has('error'))
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ Session::get('error') }}
			</div>
		@endif
	
		<div class="row" style="">
		
		
			<nav class="nav  navbar-static-top">
				<div class="container">
		 			<div class="navbar-header">
      					<button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#navbar" >
        					<span class="sr-only">Toggle navigation</span>
        					<span class="icon-bar"></span>
        					<span class="icon-bar"></span>
       						<span class="icon-bar"></span>
     					</button>
      					<a class="navbar-brand" href="/">EKSPERTEN</a>
   					</div>
    				<div class="collapse navbar-collapse" id="navbar">
						<ul class="nav navbar-nav">
						 
							<li ><a href="/">Home</a></li>
							
							
						</ul>
						@if (Auth::guest())
						<ul class="nav navbar-nav navbar-right">
							<li><a href="/login" type="btn">Login</a></li>
							<li><a href="/register" type="btn">Register</a></li>
						@endif
						</ul>
						@if (Auth::check())
						<ul class="nav navbar-nav navbar-right">
							@if (Auth::user()->admin == 1)								
								<li class=><a href="/admin" type="btn">admin</a></li>
							@endif	
																
								<li class=><a href="/logout" type="btn">Logout</a></li>
						@endif
							</ul>
						
						
					</div>
				</div>
			</nav>
		</div>	
		
		
		<div class="container" style="margin-top: 10px;">
		{{-- @if (Auth::check() && (Auth::user()->admin == 1))
		<h2>ADMIN</h2>
		@endif --}}
			<div class="col-md-8">
				@yield('content')
			</div>
			
		
		{{-- <div class="col-md-3 col-md-offset-1 " style="border:1px solid red;">
				<p>jfgdfkhjfgkh</p>
				<p>jfgdfkhjfgkh</p>
				<p>jfgdfkhjfgkh</p>
				<p>jfgdfkhjfgkh</p>
				<p>jfgdfkhjfgkh</p>
			</div>	 --}}
		</div>
	</div>
</body>
</html>
