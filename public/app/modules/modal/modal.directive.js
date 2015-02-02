(function() {
    'use strict';

    angular
        .module('app')
        .directive('modal', modal);

    modal.$inject = ['$state', '$rootScope', '$stateParams'];
    function modal ($state, $rootScope, $stateParams) {
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

          scope.transform = function(name) {
            name = name.replace(' ', '-');
            name = name.toLowerCase();
            return name;
          }
        }
    }
})();
