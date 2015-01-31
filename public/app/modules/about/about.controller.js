(function() {
    'use strict';

    angular
        .module('app')
        .controller('About', About);

    /* @ngInject */
    function About() {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'about';
        vm.content = '';

        activate();

        function activate() {
        	vm.content = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam eligendi vitae tempore dolores sunt ullam nobis. Ducimus necessitatibus placeat quisquam repudiandae, magnam minus obcaecati voluptatum similique itaque, nesciunt cumque vero.';
        }
    }
})();