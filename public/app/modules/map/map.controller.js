(function() {
    'use strict';

    angular
        .module('app')
        .controller('Map', Map);

    /* @ngInject */
    Map.$inject = ['activities', '$window', '$rootScope', '$stateParams']; // activities come from resolve

    function Map(activities, $window, $rootScope, $stateParams) {
        /*jshint validthis: true */
        var vm = this;
        vm.title = 'Map';
        vm.infoWindowVisible = false;
        vm.currentActivity = null;
        vm.filterQuery = null;
        vm.openMapFilter = null;

        vm.activities = activities;

        // painful hack
        $('body').addClass('kaart');

        if ($stateParams.name) {
          $rootScope.closeModal();
          $stateParams.name = $stateParams.name.replace('-', ' ');
          vm.filterQuery = $stateParams.name;
        }

        var tooltip = document.getElementById('tooltip');
        var tooltipName = document.getElementById('tooltipName');
        var tooltipCategories = document.getElementById('tooltipCategories');
        var infoWindow = document.getElementById('infoWindow');
        var infoWindowName = document.getElementById('infoWindowName');
        var infoWindowDescription = document.getElementById('infoWindowDescription');
        var myIcon = new google.maps.MarkerImage("/img/icons/location_red.png", null, null, null, new google.maps.Size(30,30));
        // console.log(activities);

        vm.map = {
            center: { latitude: 52.429757, longitude: 4.692685 },
            zoom: 13,
            options: {
                scrollwheel: false
            },
            events: {
                dragstart: function() {
                    // infoWindow.style.display = 'none';
                    // vm.infoWindowVisible = false;
                }
            }
        };

        vm.marker = {
            coords: {
                latitude: 52.413307,
                longitude: 4.680558
            },
            icon: myIcon,
            events:  {
                mouseover: function(gMarker, eventName, model) {
                    if (!vm.infoWindowVisible) {
                        var left = ($window.event.clientX+50) + 'px';
                        var top = ($window.event.clientY-50) + 'px';
                        tooltip.style.display = 'block';
                        tooltip.style.left = left;
                        tooltip.style.top = top;
                        tooltipName.innerHTML = gMarker.name;
                        tooltipCategories.innerHTML = '';

                        angular.forEach(gMarker.categories, function(val, key) {
                            $('<div class="category"><img src="/img/icons/'+val+'_white.png"><span>'+val+'</span></div>').appendTo($(tooltipCategories));
                        });
                    };
                },
                mouseout: function(gMarker, eventName, model) {
                    var tooltip = document.getElementById('tooltip');
                    tooltip.style.display = 'none';
                },
                click: function(gMarker, eventName, model) {
                    var left = ($window.event.clientX+50) + 'px';
                    var top = ($window.event.clientY-50) + 'px';

                    vm.currentActivity = gMarker;

                    vm.infoWindowVisible = true;
                    tooltip.style.display = 'none';
                    infoWindow.style.display = 'block';
                    infoWindowDescription.innerHTML = gMarker.short_desc
                    infoWindowName.innerHTML = gMarker.name;
                }
            },
            show: false
        };

        activate();

        function activate() {
        }

        vm.closeInfoWindow = function() {
            vm.infoWindowVisible = false;
            vm.currentActivity = null;
        }
    }
})();
