'use strict';

var current = '';

var setActiviteit = function(id) {
	current = id;
};

var getActiviteit = function() {
	return current;
};

app.controller('KaartCtrl', function ($scope, $rootScope, $window, $routeParams, $interval, $timeout) {

	$scope.currentActiviteit = null;
	$scope.kaartActiviteit = null;

	$(document).on('click', '.infoWindowLink', function(event){
		var id = $window.getActiviteit();
		$scope.singleHandler.showSingle(id);
	});

	if ($routeParams) {
		var naamFilter = $routeParams.param;
        $scope.filtertje = naamFilter;
	}

	$scope.infoWindow = function(activiteit) {

		var colors = {
            beleven: {
                hex: '#f18a01'
            },
            doen: {
                hex: '#b7037e'
            },
            genieten: {
                hex: '#32aadf'
            },
            verblijven: {
                hex: '#dbdb00'
            }
        };

		var infoWindowContent =
			'<div class="infoContainer">' +
			'<p class="infowindow_naam" style="margin-bottom: 5px;">' + activiteit.naam + '</p>' +
			'<p>' + activiteit.short_desc + '</p>' +
			'<div class="images">' +
			'<div class="image1"><img src="' + $rootScope.config.url + activiteit.big_image2 + '"></div>' +
			'<div class="image2"><img src="' + $rootScope.config.url + activiteit.big_image3 + '"></div>' +
			'<div class="image3"><img src="' + $rootScope.config.url + activiteit.big_image4 + '"></div>' +
			'</div>' +
			'<a class="infoWindowLink" style="color:' + colors[activiteit.categorie].hex + ';" onclick="setActiviteit(' + activiteit.aID + ')">Bekijk deze activiteit</a>' +
			'<div class="lijntje" style="position: absolute; bottom: 0px; left: 0; right: 0; height: 5px; background-color:' + colors[activiteit.categorie].hex + ';"></div>' +
			'</div>';
		
		return infoWindowContent;
	};

	$('.gm-style-iw').next().className = 'bla';
	
	$scope.map = {
		center: {
			latitude: 52.433826,
			longitude: 4.694815
		},
		zoom: 14,
		bounds: {
			northeast: "84.451090, -28.588320",
			southwest: "-72.147047, -172.377385"
		},
		events: {
			tilesloaded: function (map) {
				var stop;
				stop = $interval(function() {
					google.maps.event.trigger(map, 'resize');
				}, 300);

				if ($rootScope.kaartLoaded === 0) {
					var center = new google.maps.LatLng(this.center.latitude, this.center.longitude);
					$timeout(function() {
						map.panTo(center);
					}, 400);
					$rootScope.kaartLoaded = 1;
				}
			}
		}
	};

	$scope.icons = {
		beleven: {
			icon: 'images/beleven_icon.png'
		},
		doen: {
			icon: 'images/doen_icon.png'
		},
		genieten: {
			icon: 'images/genieten_icon.png'
		},
		verblijven: {
			icon: 'images/verblijven_icon.png'
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
                            big: item.big_image1,
                            big2: item.big_image2,
                            big3: item.big_image3,
                            big4: item.big_image4
                        },
                        long_desc: item.long_desc,
                        straatnaam: item.straatnaam,
                        postcode: item.postcode,
                        plaats: item.plaats,
                        telefoon: item.telefoon,
                        website: item.website,
                        facebookUrl: item.facebook_url,
                        twitterUrl: item.twitter_url
                    };
                }
            });
            return activiteit;
        },
        closeSingle: function(evt) {
			if(evt.target.id == "single" || evt.target.className == "close") {
				$rootScope.singleHidden = true;
			}
		},
		swap: function(el, image) {
	        var bigImage = $('.bigImage > img')[0];
	        var newImage = 'http://spaarnwoude.creadiv.nl/files/' + image;
	        var element = el.toElement.src
	    
	        element = bigImage.src;
	        bigImage.src = newImage;
	       
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