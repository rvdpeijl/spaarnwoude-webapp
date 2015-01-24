(function() {
    'use strict';

    angular
        .module('app')
        .factory('activityService', activityService);

    /* @ngInject */
    activityService.$inject = ['$http', 'FacebookProfiler']
    function activityService($http, FacebookProfiler) {
        var service = {
            getActivities: getActivities,
            getActivitiesByFbProfile: getActivitiesByFbProfile
        };
        return service;

        ////////////////

        function getActivities() {
        	return $http.get('/api/activities')
        		.then(complete)
        		.catch(failed);

        	function complete(response) {
        		return response.data;
        	}

        	function failed(response) {
        		return response.data;
        	}
        }

        function getActivitiesByFbProfile(user) {
            return $http.get('/api/activities')
                .then(complete)
                .catch(failed);

            function complete(response) {
                return FacebookProfiler.recommend(response.data, user);
            }

            function failed(response) {
                return response.data;
            }
        }
    }
})();