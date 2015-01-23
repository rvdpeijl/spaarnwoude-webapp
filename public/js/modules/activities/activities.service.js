(function() {
    'use strict';

    angular
        .module('app')
        .factory('activityService', activityService);

    /* @ngInject */
    function activityService($http) {
        var service = {
            getActivities: getActivities
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
    }
})();