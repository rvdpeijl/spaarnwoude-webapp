'use strict';

var app = angular.module('spaarnwoudeApp', [
  'ngCookies',
  'ngResource',
  'ngSanitize',
  'ngRoute'
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