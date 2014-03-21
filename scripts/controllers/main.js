'use strict';

app.run(function($rootScope, activiteiten){

    $rootScope.activiteiten = [];

    activiteiten.success(function(data) { 
        $rootScope.activiteiten = data;
    })

    $rootScope.singleHidden = true;

    $rootScope.config = {
		env: 'staging',
		url: 'http://spaarnwoude.creadiv.nl/files'
    };

})

app.factory('activiteiten', function($http) { 
    return $http.get('http://spaarnwoude.creadiv.nl/api/activiteiten');
})

app.factory('weerData', function($http) { 
    return $http.get('http://api.openweathermap.org/data/2.5/forecast/daily?q=Spaarndam&mode=json&units=metric&cnt=5');
})

app.controller('AppCtrl', function($scope, $rootScope, weerData) {
    
})
