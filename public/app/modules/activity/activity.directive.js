(function() {
    'use strict';

    angular
        .module('app')
        .directive('activity', activity);

    /* @ngInject */
    function activity() {
        // Usage:
        //
        // Creates:
        //
        var directive = {
            link: link,
            restrict: 'E',
            scope: { activity: '=' },
            templateUrl: '/app/modules/activity/views/activity.html'
        };
        return directive;

        function link(scope, element, attrs) {
        	// 
        }
    }
})();