(function() {
    'use strict';

    angular
        .module('app')
        .controller('Map', Map);

    /* @ngInject */
    Map.$inject = ['activities']; // activities come from resolve

    function Map(activities) {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'Map';
        vm.activities = activities;
        vm.map = { 
            center: { latitude: 52.413307, longitude: 4.680558 }, 
            zoom: 13 
        };

        vm.marker = {
            coords: {
                latitude: 52.413307,
                longitude: 4.680558
            },
            icon: '/img/icons/blue_location.png',
            options: { name: 'Marky Marker' },
            events:  { 
                mouseover: function(gMarker, eventName, model) {
                    vm.marker.show = true;
                    console.log(eventName);
                },
                mouseout: function(gMarker, eventName, model) {
                    vm.marker.show = false;
                }
            },
            show: false
        };

        activate();

        function activate() {
        }
    }
})();