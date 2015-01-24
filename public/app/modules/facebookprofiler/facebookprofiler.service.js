(function() {
    'use strict';

    angular
        .module('app')
        .factory('FacebookProfiler', FacebookProfiler);

    /* @ngInject */
    function FacebookProfiler() {
        var service = {
            recommend: recommend
        };
        return service;

        ////////////////

        function recommend(activities, user) {
        	console.log(activities);
        	console.log(user);

        	return activities;
        }
    }
})();