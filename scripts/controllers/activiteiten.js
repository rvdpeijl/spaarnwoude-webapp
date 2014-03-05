'use strict';

app.controller('ActiviteitenCtrl', function ($scope, $rootScope) {
    $scope.getActivity = function(id) {
        var activiteit = _.filter($rootScope.activiteiten, function(a) {
           return a.id === id;
        })
        $rootScope.activiteit = activiteit;
        console.log(activiteit)

    }
})