(function() {
    'use strict';

    angular
        .module('app')
        .factory('activityService', activityService);

    /* @ngInject */
    activityService.$inject = ['$http', 'FacebookProfiler']
    function activityService($http, FacebookProfiler) {
        var service = {
            getActivities: getActivities,
            getActivitiesByFbProfile: getActivitiesByFbProfile
        };
        return service;

        ////////////////

        function getActivities() {
        	return $http.get('/api/activities')
        		.then(complete)
        		.catch(failed);

        	function complete(response) {
                return response.data;

          //       var activities = [];

          //       angular.forEach(response.data, function(activity, key) {
          //           var bla = {
          //               name: activity.naam,
          //               organization: activity.organisatie,
          //               latitude: activity.latitude,
          //               longitude: activity.longitude,
          //               short_desc: activity.short_desc,
          //               long_desc: activity.long_desc,
          //               address: activity.straatnaam,
          //               zipcode: activity.postcode,
          //               city: activity.plaats,
          //               phone: activity.telefoon,
          //               website_url: activity.website_url,
          //               facebook_url: activity.facebook_url,
          //               twitter_url: activity.twitter_url,
          //               img1: 'http://spaarnwoude.creadiv.nl/files'+activity.big_image1,
          //               categories: [activity.categorie]
          //           };

          //           activities.push(bla);
          //       });

        		// return activities;
        	}

        	function failed(response) {
        		return response.data;
        	}
        }

        function getActivitiesByFbProfile(user) {
            return $http.get('/api/activities')
                .then(complete)
                .catch(failed);

            function complete(response) {
                return FacebookProfiler.recommend(response.data, user);
            }

            function failed(response) {
                return response.data;
            }
        }

        function testData () {

            // $table->increments('id');
            // $table->string('name');
            // $table->string('organization');
            // $table->double('latitude', 9, 6);
            // $table->double('longitude', 9, 6);
            // $table->text('short_desc', 255);
            // $table->longText('long_desc', 1500);
            // $table->string('address');
            // $table->string('zipcode', 6);
            // $table->string('city');
            // $table->string('phone', 20);
            // $table->string('website_url')->nullable();
            // $table->string('facebook_url')->nullable();
            // $table->string('twitter_url')->nullable();
            // $table->string('logo')->nullable();
            // $table->string('img1');
            // $table->string('img2')->nullable();
            // $table->string('img3')->nullable();
            // $table->string('img4')->nullable();
            // $table->string('img5')->nullable();
            // $table->timestamps();


            return $http.get('http://spaarnwoude.creadiv.nl/api/activiteiten')
                .then(function(response) {
                    var activities = [];

                    angular.forEach(response.data, function(activity, key) {
                        var bla = {
                            name: activity.naam,
                            organization: activity.organisatie,
                            latitude: activity.latitude,
                            longitude: activity.longitude,
                            short_desc: activity.short_desc,
                            long_desc: activity.long_desc,
                            address: activity.straatnaam,
                            zipcode: activity.postcode,
                            city: activity.plaats,
                            phone: activity.telefoon,
                            website_url: activity.website_url,
                            facebook_url: activity.facebook_url,
                            twitter_url: activity.twitter_url,
                            img1: 'image.jpg'
                        };

                        activities.push(bla);
                    });

                    console.log(activities);

					return activities;
                });
        }
    }
})();