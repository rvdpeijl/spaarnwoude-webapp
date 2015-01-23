(function() {
    'use strict';

    angular
        .module('app')
        .controller('Dashboard', Dashboard);

    /* @ngInject */
    Dashboard.$inject = ['activityService', '$rootScope', 'weatherService', 'ngProgress']; // activities come from resolve

    function Dashboard(activityService, $rootScope, weatherService, ngProgress) {
        /*jshint validthis: true */
        ngProgress.color('#59ABE3');
        var vm = this;
        vm.title = 'Dashboard';
        vm.activities = null;
        vm.forecast = null;
        vm.currentWeather = null;

        activate();

        function activate() {
            ngProgress.start();
            
            return activityService.getActivities().then(function(data) {

                ngProgress.set(50);
                vm.activities = data;

                weatherService.getForecast().then(function(data) {
                    ngProgress.set(75);
                    vm.forecast = data;

                    weatherService.currentWeather().then(function(data) {
                        vm.currentWeather = data;
                        ngProgress.complete();
                    });
                });

            });
        }
    }
})();