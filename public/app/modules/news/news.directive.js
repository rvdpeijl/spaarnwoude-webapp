(function() {
    'use strict';

    angular
        .module('app')
        .directive('news', news);

    /* @ngInject */
    function news() {
        // Usage:
        //
        // Creates:
        //
        var directive = {
            link: link,
            restrict: 'E',
            scope: { news: '=' },
            templateUrl: '/app/modules/news/views/news.html'
        };
        return directive;

        function link(scope, element, attrs) {
        }
    }
})();