<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Spaarnwoude Admin Panel</title>
	<link rel="stylesheet" href="/styles/css/main.css">
	<script type="text/javascript" src="/lib/jquery/jquery.js"></script>
	<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>

	<script type="text/javascript" src="/js/activityfiller.js"></script>
	<script type="text/javascript" src="/lib/angular/angular.js"></script>
	<script type="text/javascript" src="/js/admin.module.js"></script>
</head>
<body class="admin" ng-app="app">
	<footer class="footer-2" role="contentinfo">
	<div class="outer-container">
	  <div class="footer-logo">
	    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="Logo image">
	  </div>
	    <ul>
	      	@if(Auth::check())
				<li><a href="/admin">Admin Dashboard</a></li>
				<li><a href="/admin/activities">Activiteiten</a></li>
				<li><a href="/admin/agenda">Agenda</a></li>
				<li><a href="/admin/news">Nieuws</a></li>
	        @endif
	    </ul>

	    <div class="footer-secondary-links">
	      <ul>
	        @if(Auth::check())
	        <li><a href="/" target="_blank">Naar de website</a></li>
	        <li><a href="/logout">Uitloggen</a></li>
	        @endif
	      </ul>
	    </div>
	</div>
	</footer>
	<br><br>
	<div class="content outer-container">
		@if(Session::has('message'))
		    <div class="flash-success">
				<span>{{ Session::get('message') }}</span>
			</div>
		@endif
		@if(Session::has('error'))
		    <div class="flash-error">
				<span>{{ Session::get('error') }}</span>
				<ul>
			        @foreach($errors->all() as $error)
			            <li>{{ $error }}</li>
			        @endforeach
			    </ul>
			</div>
		@endif

        @yield('content')
    </div>
</body>
</html>