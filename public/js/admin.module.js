(function() {
    'use strict';

    angular
        .module('app', [], function($interpolateProvider) {
        	$interpolateProvider.startSymbol('[[');
    		$interpolateProvider.endSymbol(']]');
        })
        .factory('activities', activitiesProvider)
        .controller('activities', activitiesController);

        activitiesController.$inject = ['$scope', 'activities'];

        /* @ngInject */
	    function activitiesProvider($http, $rootScope) {
	        var service = {
	            findAll: findAll,
	            findOne: findOne,
	        };
	        return service;

	        ////////////////

	        function findAll() {
	        	return $http.get('/api/activities')
	        		.then(function(response) {
	        			$rootScope.activities = response.data;
	        			return response.data;
	        		})
	        		.catch(function(error) {
	        			console.log(error);
	        		})
	        }

	        function findOne (id) {
	        	return $http.get('/api/activities/' + id)
	        		.then(function(response) {
	        			$rootScope.activity = response.data;
	        			return response.data;
	        		})
	        		.catch(function(error) {
	        			console.log(error);
	        		})
	        }
	    }

	    function activitiesController($scope, activities) {
	    	$scope.activity = null;
	    	$scope.images = [];
	    	$scope.deleted = [];
	    	var id = $('#activityId').val();

	    	activities.findOne(id).then(function(data) {
	    		$scope.activity = data;

	    		$scope.images.push(
	    			{ name: 'img1', img: data.img1 },
	    			{ name: 'img2', img: data.img2 },
	    			{ name: 'img3', img: data.img3 },
	    			{ name: 'img4', img: data.img4 }
	    		);
	    	});

	    	$scope.remove = function(index, image) {
	    		$scope.images.splice(index, 1);
	    		$scope.deleted.push(image);
	    	}
	    }
})();