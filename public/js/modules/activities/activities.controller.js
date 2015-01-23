(function() {
    'use strict';

    angular
        .module('app')
        .controller('Activities', Activities);

    Activities.$inject = ['activities'];
    function Activities(activities) {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'Activities';
        vm.activities = activities;

        activate();

        function activate() {
        }
    }
})();