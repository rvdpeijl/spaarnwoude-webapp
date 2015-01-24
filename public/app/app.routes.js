(function() {
    'use strict';

    angular
        .module('app')
        .config(config);

    config.$inject = ['$stateProvider', '$urlRouterProvider', 'FacebookProvider'];

    function config($stateProvider, $urlRouterProvider, FacebookProvider) {
        FacebookProvider.init('299004140247778');

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