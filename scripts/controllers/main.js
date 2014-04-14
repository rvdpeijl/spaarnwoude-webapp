'use strict';

app.run(function($rootScope, activiteiten, agenda, facebook){
    $rootScope.facebookUserInfo = {
    }
    $rootScope.kaartLoaded = 0;
    $rootScope.facebookUserImages = {
    }

    $rootScope.fbLoggedIn = false;

    $rootScope.activiteiten = [];
    $rootScope.facebook;

    activiteiten.success(function(data) {
        $rootScope.activiteiten = data;
    })

    agenda.success(function(data) {
        $rootScope.agenda = data;
    })

    $rootScope.singleHidden = true;

    $rootScope.config = {
		env: 'staging',
		url: 'http://spaarnwoude.creadiv.nl/files',
        home: 'http://localhost/spaarnwoude-webapp'
    };

})

app.factory('activiteiten', function($http) {
    return $http.get('http://spaarnwoude.creadiv.nl/api/activiteiten');
})

app.factory('agenda', function($http) {
    return $http.get('http://spaarnwoude.creadiv.nl/api/agenda');
})

app.factory('weerData', function($http) {
    return $http.get('http://api.openweathermap.org/data/2.5/forecast/daily?q=Spaarndam&mode=json&units=metric&cnt=5');
})

app.controller('AppCtrl', function($scope, $rootScope, weerData) {

})

app.controller('FbCtrl', function($scope, $rootScope) {
    // $scope.fbLogout = facebook.facebook.getUser.fbLogout();
    $scope.fbLogout = function() {
        FB.logout();
    }

    $scope.fbLogin = function() {
        FB.login();
    }
})

app.animation('.fade', function() {
  return {
    beforeAddClass : function(element, className, done) {
      if(className == 'ng-hide') {
        jQuery(element).animate({
          opacity:0
        }, done);
      }
      else {
        done();
      }
    },
    removeClass : function(element, className, done) {
      if(className == 'ng-hide') {
        element.css('opacity',0);
        jQuery(element).animate({
          opacity:1
        }, done);
      }
      else {
        done();
      }
    }
  };
});
