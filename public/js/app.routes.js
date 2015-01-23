(function() {
    'use strict';

    angular
        .module('app')
        .config(routes);

    routes.$inject = ['$stateProvider', '$urlRouterProvider'];

    function routes($stateProvider, $urlRouterProvider) {
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
            .state('map', {
                url: '/kaart',
                templateUrl: 'js/modules/map/views/index.html',
                controller: 'Map',
                controllerAs: 'vm',
                resolve: {
                    activities: function(activityService) {
                        return activityService.getActivities();
                    }
                }
            })
    }
})();