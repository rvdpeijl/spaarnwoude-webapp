(function() {
    'use strict';

    angular
        .module('app')
        .directive('map', map);

    /* @ngInject */
    function map() {
        // Usage:
        //
        // Creates:
        //
        var directive = {
            link: link,
            restrict: 'E',
            scope: { map: '=' },
            templateUrl: '/app/modules/map/views/map.html'
        };
        return directive;

        function link(scope, element, attrs) {
        	// 
        }
    }
})();