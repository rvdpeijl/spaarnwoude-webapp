(function() {
    'use strict';

    angular
        .module('app')
        .controller('Dashboard', Dashboard);

    /* @ngInject */
    Dashboard.$inject = ['activities']; // activities come from resolve

    function Dashboard(activities) {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'Dashboard';
        vm.activities = activities;

        activate();

        function activate() {
        	
        }
    }
})();