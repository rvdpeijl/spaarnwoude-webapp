(function() {
    'use strict';

    angular
        .module('app')
        .controller('App', App);

    App.$inject = ['$scope', '$rootScope', 'Facebook'];
    function App($scope, $rootScope, Facebook) {

    	$rootScope.user = {
    		loggedin: false,
    		id: null,
    		picture: {
    			is_silhouette: false,
    			url: null
    		}
    	}

    	getLoginStatus();


    	/**
    	*
    	* Activity Modal
    	*
    	**/


		$rootScope.showModal = function(activity) {
			$rootScope.$emit('showModal', activity);
		}

		$rootScope.closeModal = function() {
			$rootScope.$emit('closeModal');
		}

		$rootScope.$on('showModal', function (event, activity) {
			$rootScope.activity = activity;
		});

		$rootScope.$on('closeModal', function (event) {
			$rootScope.activity = null;
		});


		/**
		*
		* Facebook Login
		*
		**/


		function getLoginStatus () {
            Facebook.getLoginStatus(function(response) {
              console.log(response)
                if(response.status === 'connected') {
                	$rootScope.user.loggedin = true;
                	$rootScope.user.id = response.authResponse.userID;

                	$rootScope.FacebookApiQuery($rootScope.user.id, 'picture').then(function(response) {
                		$rootScope.user.picture = response.data;
                	});
                } else {
                	$rootScope.user.loggedin = false;
                    console.log('not connected', response);
                }
            });
        };

        $rootScope.login = function() {
            Facebook.login(function(response) {
              $rootScope.user.loggedin = true;

              // refresh browser to activate facebook user
              location.reload();
            });
        }

        $rootScope.me = function() {
            return Facebook.api('/me', function(response) {
                return response;
            });
        };

        $rootScope.FacebookApiQuery = function(userId, query) {
        	return Facebook.api('/' + userId + '/' + query, function(response) {
                return response;
            });
        };

        $rootScope.logout = function() {
            Facebook.logout(function() {
                $rootScope.user.loggedin = false;

                // refresh browser to activate facebook user
                location.reload();
            })
        }

    }
})();
