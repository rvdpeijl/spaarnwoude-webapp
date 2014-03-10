'use strict';

app.controller('KaartCtrl', function ($scope, $rootScope) {
	$scope.map = {
	    center: {
	        latitude: 45,
	        longitude: -73
	    },
	    zoom: 6,
	    bounds: {
	    	northeast: "84.451090, -28.588320",
	    	southwest: "-72.147047, -172.377385"
	    }
	};

	$scope.icon = '../spaarnwoude/images/yeoman.png';

	$scope.getActiviteit = function(activiteit) {
		var self = activiteit;
		console.log(self.activiteit);
		$rootScope.singleHidden = false;
	};
})