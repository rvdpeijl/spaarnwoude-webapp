<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Spaarnwoude Admin Panel</title>
	<link rel="stylesheet" href="/styles/css/main.css">
</head>
<body>
	<footer class="footer-2" role="contentinfo">
	  <div class="footer-logo">
	    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="Logo image">
	  </div>
	    <ul>
	      	@if(Auth::check())
				<li><a href="/admin">Admin Dashboard</a></li>
				<li><a href="/admin/activities">Activiteiten</a></li>
	        @endif
	    </ul>

	    <div class="footer-secondary-links">
	      <ul>
	        @if(Auth::check())
	        <li><a href="/logout">Uitloggen</a></li>
	        @endif
	      </ul>
	    </div>

	</footer>

	@if(Session::has('message'))
	    <p class="alert">{{ Session::get('message') }}</p>
	@endif

	<div class="content">
        @yield('content')
    </div>
</body>
</html>