'use strict';

app.controller('KaartCtrl', function ($scope, $rootScope, activiteiten) {

	$scope.currentActiviteit = null;
	
	$scope.map = {
	    center: {
	        latitude: 52.433826,
	        longitude: 4.694815
	    },
	    zoom: 14,
	    bounds: {
	    	northeast: "84.451090, -28.588320",
	    	southwest: "-72.147047, -172.377385"
	    }
	};

	$scope.icons = {
		beleven: {
			icon: 'images/mapicon_beleven.png'
		},
		doen: {
			icon: 'images/mapicon_doen.png'
		},
		genieten: {
			icon: 'images/mapicon_genieten.png'
		},
		verblijven: {
			icon: 'images/mapicon_verblijven.png'
		}
	};

	$scope.infoWindow = function(activiteit) {
		var infoWindowContent =
			'<p class="infowindow_naam">' + activiteit.naam + '</p>' +
			'<br>' +
			'<p>' + activiteit.short_desc + '</p>';
		
		return infoWindowContent;
	};


	$scope.getActiviteit = function(activiteit) {
		var self = activiteit;
		console.log(self.activiteit);
		$rootScope.singleHidden = false;
	};

	$scope.openWindow = function(id) {
		$scope.currentActiviteit = id;
		console.log($scope.currentActiviteit);
	};

	$scope.isCurrentActiviteit = function(activiteit) {
		return $scope.activitieit === activiteit;
	};

	$scope.filter = function(categorie) {
		$scope.filtertje = categorie;
		$('.filter').val(categorie);
	};

})