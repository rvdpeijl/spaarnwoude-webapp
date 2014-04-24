'use strict';

app.controller('AgendaCtrl', function ($scope, $rootScope, $routeParams) {
    $rootScope.kaartLoaded = 0;
    $scope.getAgendaColor = function(categorie) {
      var colors = {
              beleven: {
                  hex: '#f18a01'
              },
              doen: {
                  hex: '#b7037e'
              },
              genieten: {
                  hex: '#32aadf'
              },
              verblijven: {
                  hex: '#dbdb00'
              }
          };
      return colors[categorie].hex;
    }
});
