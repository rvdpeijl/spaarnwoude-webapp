'use strict';

app.controller('ActiviteitenCtrl', function ($scope, $rootScope) {
    $scope.getActivity = function(id) {
        var activiteit = _.filter($rootScope.activiteiten, function(a) {
           return a;
        });

        $rootScope.activiteit = activiteit;
        console.log(activiteit)

    }
})