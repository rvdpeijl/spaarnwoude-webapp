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

                    case 'sky is clear':
                      return '/img/icons/weather-icons/clear_sky.png';
                    break;

                    case 'Sky is Clear':
                      return '/img/icons/weather-icons/clear_sky.png';
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

                    case 'calm':
                        return '/img/icons/weather-icons/clear_sky.png';
                    break;

                    case 'light rain':
                        return '/img/icons/weather-icons/rain.png';

                    default:
                        return null;
                    break;
                }
            }

            scope.translateDesc = function(desc) {
                switch(desc) {
                    case 'broken clouds':
                        return 'Zware bewolking';
                    break;

                    case 'few clouds':
                        return 'Licht bewolkt';
                    break;

                    case 'scattered clouds':
                        return 'Bewolking';
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
