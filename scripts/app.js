'use strict';

var app = angular.module('spaarnwoudeApp', [
  'ngRoute',
  'ngAnimate',
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
    .when('/activiteiten/categorie/:categorie', {
      templateUrl: 'views/activiteiten.html',
      controller: 'ActiviteitenCtrl'
    })
    .when('/kaart', {
      templateUrl: 'views/kaart.html',
      controller: 'KaartCtrl'
    })
    .when('/kaart/:id', {
      templateUrl: 'views/kaart.html',
      controller: 'KaartCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });

});
