(function() {
    'use strict';

    angular
        .module('app')
        .controller('Map', Map);

    /* @ngInject */
    Map.$inject = ['activities', '$window', '$rootScope']; // activities come from resolve

    function Map(activities, $window, $rootScope) {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'Map';
        vm.activities = activities;
        vm.infoWindowVisible = false;

        var tooltip = document.getElementById('tooltip');
        var infoWindow = document.getElementById('infoWindow');
        var infoWindowName = document.getElementById('infoWindowName');
        var infoWindowDescription = document.getElementById('infoWindowDescription');

        vm.map = { 
            center: { latitude: 52.413307, longitude: 4.680558 }, 
            zoom: 13,
            options: {
                scrollwheel: false
            },
            events: {
                dragstart: function() {
                    infoWindow.style.opacity = 0;
                    vm.infoWindowVisible = false;
                }
            }
        };

        vm.marker = {
            coords: {
                latitude: 52.413307,
                longitude: 4.680558
            },
            icon: '/img/icons/blue_location.png',
            options: { name: 'Marky Markskizzle', description: 'Dit is descripzur' },
            events:  { 
                mouseover: function(gMarker, eventName, model) {
                    if (!vm.infoWindowVisible) {
                        var left = ($window.event.clientX) + 'px';
                        var top = ($window.event.clientY-50) + 'px';
                        tooltip.style.opacity = 100;
                        tooltip.style.left = left;
                        tooltip.style.top = top;
                        tooltip.innerHTML = gMarker.name;
                    };
                },
                mouseout: function(gMarker, eventName, model) {
                    var tooltip = document.getElementById('tooltip');
                    tooltip.style.opacity = 0;
                },
                click: function(gMarker, eventName, model) {
                    var left = ($window.event.clientX) + 'px';
                    var top = ($window.event.clientY-50) + 'px';

                    vm.infoWindowVisible = true;
                    tooltip.style.opacity = 0;
                    infoWindow.style.opacity = 100;
                    infoWindow.style.left = left;
                    infoWindow.style.top = top;
                    infoWindowDescription.innerHTML = gMarker.description
                    infoWindowName.innerHTML = gMarker.name;
                }
            },
            show: false
        };

        activate();

        function activate() {
        }
    }
})();