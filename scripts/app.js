'use strict';

var app = angular.module('spaarnwoudeApp', [
  'ngRoute',
  'google-maps'
]);

app.config(function ($routeProvider) {
  $routeProvider
    .when('/', {
      templateUrl: 'views/home.html',
      controller: 'HomeCtrl'
    })
    .when('/activiteiten', {
      templateUrl: 'views/activiteiten.html',
      controller: 'ActiviteitenCtrl'
    })
    .when('/kaart', {
      templateUrl: 'views/kaart.html',
      controller: 'KaartCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });

});