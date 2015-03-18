(function() {
    'use strict';

    angular
        .module('app')
        .controller('Agenda', Agenda);

    Agenda.$inject = ['agenda'];
    function Agenda(agenda) {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'agenda';
        vm.agenda = agenda;

        activate();

        function activate() {

            vm.agenda.forEach(function(item) {
                item.sortDate = new Date(item.start)
            });

        }
    }
})();