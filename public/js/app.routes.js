(function() {
    'use strict';

    angular
        .module('app')
        .config(config);

    config.$inject = ['$stateProvider', '$urlRouterProvider'];

    function config($stateProvider, $urlRouterProvider) {
    	$urlRouterProvider.otherwise("/dashboard");

    	$stateProvider
            .state('dashboard', {
                url: '/',
                templateUrl: 'js/modules/dashboard/views/index.html'
            })
            .state('activities', {
                url: '/activiteiten',
                templateUrl: 'js/modules/activities/views/index.html'
            })
    }
})();