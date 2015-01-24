(function() {
    'use strict';

    angular
        .module('app')
        .controller('Activity', Activity);

    Activity.$inject = ['activities'];
    function Activity(activities) {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'Activities';
        vm.activities = activities;

        activate();

        function activate() {
        }
    }
})();