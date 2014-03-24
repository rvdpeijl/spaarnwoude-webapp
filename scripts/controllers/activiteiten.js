'use strict';

app.controller('ActiviteitenCtrl', function ($scope, $rootScope) {

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
                        }
                    };
                }
            });
            return activiteit;
        },
        closeSingle: function(evt) {
			if(evt.target.id == "single" || evt.target.className == "close" || evt.target.id == "openKaart") {
				$rootScope.singleHidden = true;
			}
		}
    };
});