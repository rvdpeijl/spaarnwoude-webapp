(function() {
    'use strict';

    angular
        .module('app')
        .factory('agendaService', agendaService);

    /* @ngInject */
    function agendaService($http) {
        
        var service = {
            getAgenda: getAgenda
        };
        return service;

        ////////////////

        function getAgenda() {
        	return $http.get('/api/agenda')
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