'use strict';

app.run(function($rootScope, activiteiten){
    activiteiten.success(function(data) { 
        $rootScope.activiteiten = data;
    })

    $rootScope.activiteit = {
        naam:'undefined',
    }

})

app.factory('activiteiten', function($http) { 
    return $http.get('../data/activiteiten.json');
})

app.factory('weerData', function($http) { 
    return $http.get('http://api.openweathermap.org/data/2.5/forecast/daily?q=Spaarndam&mode=json&units=metric&cnt=5');
})

app.controller('AppCtrl', function($scope, $rootScope, weerData) {
    $rootScope.activiteit = {};
})

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

app.controller('ActiviteitenCtrl', function ($scope, $rootScope) {
    $scope.getActivity = function(id) {
        var activiteit = _.filter($rootScope.activiteiten, function(a) {
           return a.id === id;
        })

        $rootScope.activiteit = activiteit;
    }
})

app.controller('KaartCtrl', function ($scope) {

})