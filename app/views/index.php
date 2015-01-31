<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Spaarnwoude App</title>
	<script type="text/javascript" src="/lib/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="/lib/angular/angular.js"></script>
	<script src="/node_modules/angular-touch/angular-touch.js"></script>
	<script src='//maps.googleapis.com/maps/api/js?sensor=false'></script>
	<link href="/lib/ng-carousel/angular-carousel.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="/styles/css/font-awesome.css">
	<link rel="stylesheet" href="/styles/css/main.css">
	<link rel='stylesheet' href='/lib/ngprogress/ngProgress.css'/>
</head>
<body ng-app="app" ng-controller="App">

	<modal ng-if="$root.activity" activity="$root.activity"></modal>
	<nav>
	<div class="outer-container">
		<ul>
			<li class="logo">
				<a href="#/">
					<img width="260" src="img/logo.png" alt="">
				</a>
			</li>
			<li ng-repeat="menuItem in $root.config.menuItems"><a ui-sref="{{menuItem.slug}}">{{menuItem.name}}</a></li>
		</ul>

		<div class="social">
			<!-- <div ng-repeat="platform in \$root.config.social">
				<a href="{{platform.url}}" target="_blank">{{platform.name}}</a>
			</div> -->

			<ul class="socialList">
				<li class="facebook"><a href="javascript:void(0)"><span><i class="fa fa-facebook"></i></span></a></li>
				<li class="twitter"><a href="javascript:void(0)"><span><i class="fa fa-twitter"></i>
</span></a></li>
				<li class="email"><a href="javascript:void(0)"><span><i class="fa fa-envelope-o"></i>
</span></a></li>
			</ul>
		</div>
		</div>
	</nav>

	<div class="outer-container">
		<div ui-view></div>
	</div>
	<!-- Lib Files -->
	<script type="text/javascript" src="/lib/angular-facebook/angular-facebook.js"></script>
	<script type="text/javascript" src="/lib/angular-google-maps/angular-google-maps.js"></script>
	<script type="text/javascript" src="/lib/angular-resource/angular-resource.js"></script>
	<script type="text/javascript" src="/lib/angular-ui-router/angular-ui-router.js"></script>
	<script type="text/javascript" src="/lib/lodash/lodash.min.js"></script>
	<script type="text/javascript" src="/lib/ngprogress/ngProgress.js"></script>
	<script type="text/javascript" src="/lib/ng-carousel/angular-carousel.js"></script>
	<script type="text/javascript" src="/lib/angular-sanitize/angular-sanitize.js"></script>
	<!-- Main Components -->
	<script type="text/javascript" src="/app/app.module.js"></script>
	<script type="text/javascript" src="/app/app.routes.js"></script>
	<script type="text/javascript" src="/app/app.config.js"></script>
	<script type="text/javascript" src="/app/app.controller.js"></script>

	<!-- Activities -->
	<script type="text/javascript" src="/app/modules/activity/activity.controller.js"></script>
	<script type="text/javascript" src="/app/modules/activity/activity.service.js"></script>
	<script type="text/javascript" src="/app/modules/activity/activity.directive.js"></script>

	<!-- Dashboard -->
	<script type="text/javascript" src="/app/modules/dashboard/dashboard.controller.js"></script>

	<!-- Map -->
	<script type="text/javascript" src="/app/modules/map/map.controller.js"></script>

	<!-- About -->
	<script type="text/javascript" src="/app/modules/about/about.controller.js"></script>

	<!-- Modal -->
	<script type="text/javascript" src="/app/modules/modal/modal.directive.js"></script>

	<!-- Weather -->
	<script type="text/javascript" src="/app/modules/weather/weather.service.js"></script>
	<script type="text/javascript" src="/app/modules/weather/weather.directive.js"></script>

	<!-- FacebookProfiler -->
	<script type="text/javascript" src="/app/modules/facebookprofiler/facebookprofiler.service.js"></script>

	<!-- Agenda -->
	<script type="text/javascript" src="/app/modules/agenda/agenda.service.js"></script>
	<script type="text/javascript" src="/app/modules/agenda/agenda.controller.js"></script>
	<script type="text/javascript" src="/app/modules/agenda/agenda.directive.js"></script>

	<!-- News -->
	<script type="text/javascript" src="/app/modules/news/news.service.js"></script>
	<script type="text/javascript" src="/app/modules/news/news.controller.js"></script>
	<script type="text/javascript" src="/app/modules/news/news.directive.js"></script>

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Sanchez:400italic,400' rel='stylesheet' type='text/css'>
</body>
</html>
