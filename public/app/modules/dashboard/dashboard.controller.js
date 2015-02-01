(function() {
    'use strict';

    angular
        .module('app')
        .controller('Dashboard', Dashboard);

    /* @ngInject */
    Dashboard.$inject = ['activityService', '$rootScope', 'weatherService', 'ngProgress', 'Facebook', '$state']; // activities come from resolve

    function Dashboard(activityService, $rootScope, weatherService, ngProgress, Facebook, $state) {
        /*jshint validthis: true */
        ngProgress.color('#59ABE3');
        var vm = this;
        vm.title = 'Dashboard';
        vm.activities = null;
        vm.forecast = null;
        vm.currentWeather = null;
        vm.loggedIn = false;
        vm.user = null;

        vm.state = $state;

        activate();

        function activate() {
            getLoginStatus();
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
        
        function getLoginStatus() {
            Facebook.getLoginStatus(function(response) {
                if(response.status === 'connected') {
                    vm.me();
                    vm.loggedIn = true;
                } else {
                    vm.loggedIn = false;
                }
            });
        };

        vm.login = function() {
            Facebook.login(function(response) {
                vm.me();
            });
        }

        vm.me = function() {
            Facebook.api('/me', function(response) {
                activityService.getActivitiesByFbProfile(response).then(function(activities) {
                    vm.activities = activities;
                });
            });
        };

        vm.logout = function() {
            Facebook.logout(function() {
                vm.user = null;
                console.log('logged out');
            })
        }
    }
})();
