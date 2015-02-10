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

          // swap images in the modal
          scope.swap = function(el, image, id) {

            var hostUrl = window.location.origin
            var bigImage = $('img.bigImage')[0]
            var imageToSwap = hostUrl + "/img/activities/" + id + "/medium/" + image
            var element = el.toElement.src

            element = bigImage.src

            bigImage.src = imageToSwap
            
            element = bigImage.src

          }
        }
    }
})();
