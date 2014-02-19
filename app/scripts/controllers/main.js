'use strict';

app.factory('mainData', function($http) { 
    return $http.get('../data/activiteiten.json');
});

app.factory('weerData', function($http) { 
    return $http.get('http://api.openweathermap.org/data/2.5/forecast/daily?q=Spaarndam&mode=json&units=metric&cnt=5');
});

app.controller('HomeCtrl', function ($scope, mainData, weerData) {
    $scope.activiteiten = [];
    $scope.weer = {};

    mainData.success(function(data) { 
        $scope.activiteiten = data;
    });

    weerData.success(function(data) { 
        $scope.getWeather(data);
    });

    $scope.getWeather = function getWeather(weather) {
        $scope.weer.vandaag = weather.list[0];
        $scope.weer.vandaag.dag = 'Vandaag';
        $scope.weer.morgen = weather.list[1];
        $scope.weer.morgen.dag = 'Morgen';
        $scope.weer.overmorgen = weather.list[2];
        $scope.weer.overmorgen.dag = 'Overmorgen';

        console.log($scope.weer.vandaag);
    }

});

app.controller('ActiviteitenCtrl', function ($scope, mainData) {
    $scope.activiteiten = [];
    mainData.success(function(data) { 
        $scope.activiteiten = data;
    });

});

app.controller('KaartCtrl', function ($scope, mainData) {
    $scope.activiteiten = [];
    mainData.success(function(data) { 
        $scope.activiteiten = data;
    });

});