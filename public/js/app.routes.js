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
                controllerAs: 'vm'
            })
            .state('activities', {
                url: '/activiteiten',
                templateUrl: 'js/modules/activity/views/index.html',
                controller: 'Activity',
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