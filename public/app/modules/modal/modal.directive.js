(function() {
    'use strict';

    angular
        .module('app')
        .directive('modal', modal);

    modal.$inject = ['$state', '$rootScope'];
    function modal ($state, $rootScope) {
        // Usage:
        //
        // Creates:
        //
        var directive = {
            link: link,
            restrict: 'E',
            scope: { activity: '=' },
            templateUrl: '/app/modules/modal/views/modal.html'
        };
        return directive;

        function link(scope, element, attrs) {
          scope.openMap = function(activity) {
            
          }
        }
    }
})();
