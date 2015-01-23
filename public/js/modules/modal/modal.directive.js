(function() {
    'use strict';

    angular
        .module('app')
        .directive('modal', modal);

    /* @ngInject */
    function modal () {
        // Usage:
        //
        // Creates:
        //
        var directive = {
            link: link,
            restrict: 'E',
            scope: { activity: '=' },
            templateUrl: '/js/modules/modal/views/modal.html'
        };
        return directive;

        function link(scope, element, attrs) {
        }
    }
})();