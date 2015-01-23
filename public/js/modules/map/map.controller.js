(function() {
    'use strict';

    angular
        .module('app')
        .controller('Map', Map);

    /* @ngInject */
    Map.$inject = ['activities']; // activities come from resolve

    function Map(activities) {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'Map';
        vm.activities = activities;

        activate();

        function activate() {
        }
    }
})();