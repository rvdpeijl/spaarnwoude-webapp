'use strict';

app.controller('HomeCtrl', function ($scope, $rootScope, weerData) {
    $scope.weer = {};  
    weerData.success(function(data) { 
        $scope.getWeather(data);
    })

    $scope.getWeather = function getWeather(weather) {
        $scope.weer.vandaag = weather.list[0];
        $scope.weer.vandaag.dag = 'Vandaag';
        $scope.weer.morgen = weather.list[1];
        $scope.weer.morgen.dag = 'Morgen';
        $scope.weer.overmorgen = weather.list[2];
        $scope.weer.overmorgen.dag = 'Overmorgen';
    }
})