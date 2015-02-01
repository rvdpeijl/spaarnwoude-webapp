(function() {
    'use strict';

    angular
        .module('app')
        .controller('Activity', Activity);

    Activity.$inject = ['activities', '$stateParams', '$rootScope', 'FacebookProfiler'];
    function Activity(activities, $stateParams, $rootScope, FacebookProfiler) {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'Activities';

        vm.activities = _.shuffle(activities);
        vm.cached = vm.activities;

        $rootScope.$watch('profilerEnabled', function(newValue, oldValue) {
            if ($rootScope.profilerEnabled === true) {
                FacebookProfiler.recommend(activities).then(function(recommendedActivities) {
                    vm.activities = recommendedActivities;
                });
            } else {
                vm.activities = vm.cached;

                angular.forEach(vm.activities, function(activity, key) {
                    activity.recommended = false;
                });
            }
        });

        if ($stateParams.category !== '') {
            vm.searchAct = $stateParams.category;
        };

        activate();

        function activate() {
        }
    }
})();