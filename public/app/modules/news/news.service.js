(function() {
    'use strict';

    angular
        .module('app')
        .factory('newsService', newsService);

    /* @ngInject */
    function newsService($http) {
        var service = {
            getNews: getNews
        };
        return service;

        ////////////////

        function getNews() {
        	return $http.get('/api/news')
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