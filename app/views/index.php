<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Spaarnwoude App</title>
	<script type="text/javascript" src="/js/lib/angular/angular.js"></script>
	<link rel="stylesheet" href="/styles/css/main.css">
</head>
<body ng-app="app">

	<ul>
		<li><a ui-sref="dashboard">Dashboard</a></li>
		<li><a ui-sref="activities">Activities</a></li>
	</ul>

	<div ui-view></div>
	
	<script type="text/javascript" src="/js/lib/angular/angular-ui-router.js"></script>
	<script type="text/javascript" src="/js/lib/angular/angular-resource.js"></script>

	<!-- Main Components -->
	<script type="text/javascript" src="/js/app.module.js"></script>
	<script type="text/javascript" src="/js/app.routes.js"></script>
</body>
</html>