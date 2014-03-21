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

	$scope.markers = [
		{ latitude: 45, longitude: -73, naam: 'snowplanet' },
		{ latitude: 46, longitude: -72, naam: 'klimhal' },
		{ latitude: 35, longitude: -66, naam: 'sa plaza' },
		{ latitude: 24, longitude: -74, naam: 'lasergamen 4 u' },
		{ latitude: 66, longitude: -93, naam: 'kARTen' },
		{ latitude: 63, longitude: -34, naam: '#twerkit' },
	];

	$scope.icon = '../spaarnwoude/images/yeoman.png';

	$scope.getActiviteit = function(activiteit) {
		var self = activiteit;
		console.log(self.activiteit);
		$rootScope.singleHidden = false;
	};
})