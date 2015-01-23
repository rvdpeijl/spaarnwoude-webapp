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
                templateUrl: 'js/modules/dashboard/views/index.html',
                controller: 'Dashboard',
                controllerAs: 'vm',
                resolve: {
                	activities: function(activityService) {
                		return activityService.getActivities();
                	}
                }
            })
            .state('activities', {
                url: '/activiteiten',
                templateUrl: 'js/modules/activities/views/index.html',
                controller: 'Activities',
                controllerAs: 'vm',
                resolve: {
                	activities: function(activityService) {
                		return activityService.getActivities();
                	}
                }
            })
    }
})();