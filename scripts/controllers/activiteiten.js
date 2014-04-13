'use strict';

app.controller('ActiviteitenCtrl', function ($scope, $rootScope, $routeParams) {
    $rootScope.kaartLoaded = 0;
	$scope.activiteit = {
		naam: ''
	};

    if ($routeParams) {
        var catFilter = $routeParams.categorie;
        $scope.actFilter = catFilter;
    }

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
                        website: item.website_url,
                        facebookUrl: item.facebook_url,
                        twitterUrl: item.twitter_url
                    };
                }
            });
            return activiteit;
        },
        closeSingle: function(evt) {
			if(evt.target.id == "single" || evt.target.className == "close" || evt.target.id == "openKaart") {
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
});