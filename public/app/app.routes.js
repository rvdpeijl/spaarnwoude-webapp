(function() {
    'use strict';

    angular
        .module('app')
        .config(config);

    config.$inject = ['$stateProvider', '$urlRouterProvider', 'FacebookProvider'];

    function config($stateProvider, $urlRouterProvider, FacebookProvider) {
        FacebookProvider.init('299004140247778');

    	$urlRouterProvider.otherwise('dashboard');

    	$stateProvider
            .state('dashboard', {
                url: '/dashboard',
                templateUrl: 'app/modules/dashboard/views/index.html',
                controller: 'Dashboard',
                controllerAs: 'vm'
            })
            .state('activities', {
                url: '/activiteiten',
                templateUrl: 'app/modules/activity/views/index.html',
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
                templateUrl: 'app/modules/map/views/index.html',
                controller: 'Map',
                controllerAs: 'vm',
                resolve: {
                    activities: function(activityService) {
                        return activityService.getActivities();
                    }
                }
            })
            .state('agenda', {
                url: '/agenda',
                templateUrl: 'app/modules/agenda/views/index.html',
                controller: 'Agenda',
                controllerAs: 'vm',
                resolve: {
                    agenda: function(agendaService) {
                        return agendaService.getAgenda();
                    }
                }
            })

            .state('news', {
                url: '/nieuws',
                templateUrl: 'app/modules/news/views/index.html',
                controller: 'News',
                controllerAs: 'vm',
                resolve: {
                    news: function(newsService) {
                        return newsService.getNews();
                    }
                }
            })

            .state('about', {
                url: '/over-ons',
                templateUrl: 'app/modules/about/views/index.html',
                controller: 'About',
                controllerAs: 'vm'
            })
    }
})();