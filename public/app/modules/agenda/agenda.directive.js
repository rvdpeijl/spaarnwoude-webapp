(function() {
    'use strict';

    angular
        .module('app')
        .directive('agenda', agenda);

    /* @ngInject */
    function agenda() {
        // Usage:
        //
        // Creates:
        //
        var directive = {
            link: link,
            restrict: 'E',
            scope: { item: '=' },
            templateUrl: '/app/modules/agenda/views/agenda.html'
        };

        return directive;

        function link(scope, element, attrs) {

            scope.setActive = function(item) {
                $(element).toggleClass('expanded');
            }
        }
    }
})();
