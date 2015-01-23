(function() {
    'use strict';

    angular
        .module('app')
        .controller('App', App);

    /* @ngInject */
    function App($scope, $rootScope) {

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

    }
})();