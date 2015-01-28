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
            
            scope.setIcon = function(desc) {
                switch(desc) {
                    case 'broken clouds':
                        return '/img/icons/weather-icons/broken_clouds.png';
                    break;

                    case 'few clouds':
                        return '/img/icons/weather-icons/few_clouds.png';
                    break;

                    case 'scattered clouds':
                        return '/img/icons/weather-icons/scattered_clouds.png';
                    break;

                    case 'shower rain':
                        return '/img/icons/weather-icons/rain.png';
                    break;

                    case 'rain':
                        return '/img/icons/weather-icons/rain.png';
                    break;

                    case 'thunderstorm':
                        return '/img/icons/weather-icons/thunderstorm.png';
                    break;

                    case 'snow':
                        return '/img/icons/weather-icons/snow.png';
                    break;

                    case 'mist':
                        return '/img/icons/weather-icons/mist.png';
                    break;

                    case 'overcast clouds':
                        return '/img/icons/weather-icons/scattered_clouds.png'
                    break;

                    case 'moderate rain':
                        return '/img/icons/weather-icons/rain.png';
                    break;
                    
                    default: 
                        return null;
                    break;
                }
            }

            scope.translateDesc = function(desc) {
                switch(desc) {
                    case 'broken clouds':
                        return 'BlaBlaBlaBla';
                    break;

                    case 'few clouds':
                        return 'BlaBlaBlaBla';
                    break;

                    case 'scattered clouds':
                        return 'BlaBlaBlaBla';
                    break;

                    case 'shower rain':
                        return 'BlaBlaBlaBla';
                    break;

                    case 'rain':
                        return 'BlaBlaBlaBla';
                    break;

                    case 'thunderstorm':
                        return 'BlaBlaBlaBla';
                    break;

                    case 'snow':
                        return 'BlaBlaBlaBla';
                    break;

                    case 'mist':
                        return 'BlaBlaBlaBla';
                    break;

                    case 'overcast clouds':
                        return 'BlaBlaBlaBla'
                    break;

                    case 'moderate rain':
                        return 'BlaBlaBlaBla';
                    break;
                    
                    default: 
                        return null;
                    break;
                }
            }

            scope.round = function(num) {
                return Math.round( num * 10 ) / 10;
            }
        }
    }
})();