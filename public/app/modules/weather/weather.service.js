(function() {
    'use strict';

    angular
        .module('app')
        .factory('weatherService', weatherService);

    /* @ngInject */
    function weatherService($http) {
        var service = {
            getForecast: getForecast,
            currentWeather: currentWeather
        };
        return service;

        ////////////////

        function getForecast() {
        	return $http.get('http://api.openweathermap.org/data/2.5/forecast/daily?lat=52.413307&lon=4.680558&cnt=3&mode=json&units=metric')
        		.then(complete)
        		.catch(failed);

        	function complete(response) {
            // console.log(response.data)
            return response.data;

        	}

        	function failed(response) {
        		// console.log(response);
        	}
        }

        function currentWeather() {
        	return $http.get('http://api.openweathermap.org/data/2.5/weather?lat=52.413307&lon=4.680558&units=metric')
        		.then(complete)
        		.catch(failed);

        	function complete(response) {
            console.log(response.data)
        		return response.data;
        	}

        	function failed(response) {
        		console.log(response);
        	}
        }

    }
})();
