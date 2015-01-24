(function() {
    'use strict';

    angular
        .module('app')
        .directive('weather', weather);

    /* @ngInject */
    function weather(weatherService) {
        // Usage:
        //
        // Creates:
        //
        var directive = {
            link: link,
            restrict: 'E',
            scope: { forecast: '=', currentWeather: '=' },
            templateUrl: '/app/modules/weather/views/weather.html'
        };

        return directive;

        function link(scope, element, attrs) {	
        }
    }
})();