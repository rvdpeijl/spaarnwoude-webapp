'use strict';

var current = '';

var setActiviteit = function(id) {
	current = id;
};

var getActiviteit = function() {
	return current;
};

app.controller('KaartCtrl', function ($scope, $rootScope, $window, activiteiten) {

	$scope.currentActiviteit = null;

	$(document).on('click', '#infoWindowLink', function(event){
		var id = $window.getActiviteit();
	    $scope.singleHandler.showSingle(id);
	});

	$scope.infoWindow = function(activiteit) {
		var infoWindowContent =
			'<p class="infowindow_naam">' + activiteit.naam + '</p>' +
			'<br>' +
			'<p>' + activiteit.short_desc + '</p>' +
			'<a id="infoWindowLink" onclick="setActiviteit(' + activiteit.aID + ')">Bekijk deze activiteit</a>';
		
		return infoWindowContent;
	};
	
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

	$scope.activiteit = {
		naam: ''
	};

	$scope.singleHandler = {
        showSingle: function(id) {
            $rootScope.$apply($rootScope.singleHidden = false);
            this.getActivity(id);
        },
        getActivity: function(id) {
            $scope.$apply($scope.activiteit = this.filter(id));
        },
        filter: function(id) {
            var activiteit = {};
            $scope.activiteiten.forEach(function(item) {
                if (item.aID == id) {
                    activiteit = {
                        aID: item.aID,
                        naam: item.naam,
                        categorie: item.categorie,
                        organisatie: item.organisatie,
                        images: {
                            big: item.big_image1
                        },
                        long_desc: item.long_desc

                    };
                }
            });
            return activiteit;
        },
        closeSingle: function(evt) {
			if(evt.target.id == "single" || evt.target.className == "close") {
				$rootScope.singleHidden = true;
			}
		}
    };


	$scope.getActiviteit = function(activiteit) {
		var self = activiteit;
		$rootScope.singleHidden = false;
	};

	$scope.openWindow = function(id) {
		$scope.currentActiviteit = id;
	};

	$scope.isCurrentActiviteit = function(activiteit) {
		return $scope.activitieit === activiteit;
	};

	$scope.filter = function(categorie) {
		$scope.filtertje = categorie;
		$('.filter').val(categorie);
	};

})