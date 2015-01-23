(function() {
    'use strict';

    angular
        .module('app')
        .controller('Dashboard', Dashboard);

    /* @ngInject */
    Dashboard.$inject = ['activities', '$rootScope']; // activities come from resolve

    function Dashboard(activities, $rootScope) {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'Dashboard';
        vm.activities = activities;

        activate();

        function activate() {        	
        }
    }
})();