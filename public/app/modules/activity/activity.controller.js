(function() {
    'use strict';

    angular
        .module('app')
        .controller('Activity', Activity);

    Activity.$inject = ['activities', '$stateParams'];
    function Activity(activities, $stateParams) {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'Activities';
        vm.activities = _.shuffle(activities);

        console.log($stateParams);

        if ($stateParams.category !== '') {
            vm.searchAct = $stateParams.category;
        };

        activate();

        function activate() {
        }
    }
})();