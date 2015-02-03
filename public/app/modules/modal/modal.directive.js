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

          scope.swap = function(el, image) {
            console.log(image)
            // console.log(el)
            // console.log(image)
            var bigImage = $('.bigImage > img')[0];

            var newImage = image;
            var element = el.toElement.src
            element = bigImage.src;
            bigImage.src = newImage;
            // console.log(bigImage.src)
          }
        }
    }
})();
