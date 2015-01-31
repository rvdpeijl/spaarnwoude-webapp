(function() {
    'use strict';

    angular
        .module('app')
        .controller('News', News);

    News.$inject = ['news'];
    function News(news) {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'news';
        vm.news = news;

        activate();

        function activate() {
        }
    }
})();