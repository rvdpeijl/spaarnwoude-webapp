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

