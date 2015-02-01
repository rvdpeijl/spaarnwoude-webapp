(function() {
    'use strict';

    angular
        .module('app')
        .factory('FacebookProfiler', FacebookProfiler);

    /* @ngInject */
    function FacebookProfiler($rootScope) {
        var service = {
            recommend: recommend
        };
        return service;

        ////////////////

        function recommend(activities) {

            var verblijven = [
                'hotel',
                'bags/luggage',
                'travel/leisure',
                'airport'
            ];

            var doen = [
                'outdoor gear/sporting goods',
                'sports venue',
                'sports/recreation/activities',
                'sports league',
                'professional sports team',
                'amateur sports team'
            ];

            var genieten = [
                'club',
                'bar',
                'chef',
                'kitchen/cooking',
                'spas/beauty/personal care',
                'food/grocery',
                'restaurant/cafe',
                'health/beauty'
            ];

            var beleven = [
                'tours/sightseeing',
                'shopping/retail',
                'museum/art gallery',
                'arts/entertainment/nightlife',
                'landmark',
                'attractions/things to do'
            ];

            var id = $rootScope.user.id;
            return $rootScope.FacebookApiQuery(id, 'likes').then(function(response) {

                var recommendations = {
                    doen: 0,
                    genieten: 0,
                    beleven: 0,
                    verblijven: 0
                };

                var likes = response.data.map(function(like) {
                    return like.category.toLowerCase();
                });


                angular.forEach(likes, function(category, key) {
                    if (_.contains(doen, category)) {
                        recommendations.doen++;
                    };

                    if (_.contains(genieten, category)) {
                        recommendations.genieten++;
                    };

                    if (_.contains(beleven, category)) {
                        recommendations.beleven++;
                    };

                    if (_.contains(verblijven, category)) {
                        recommendations.verblijven++;
                    };
                });

                angular.forEach(activities, function(activity, key) {
                    angular.forEach(activity.categories, function(category, key) {
                        if (category === 'Beleven' && recommendations.beleven > 0) {
                            activity.recommended = true;
                        }

                        if (category === 'Genieten' && recommendations.genieten > 0) {
                            activity.recommended = true;
                        }

                        if (category === 'Verblijven' && recommendations.verblijven > 0) {
                            activity.recommended = true;
                        }

                        if (category === 'Doen' && recommendations.doen > 0) {
                            activity.recommended = true;
                        }
                    });
                });
                console.log(activities);
                return activities;
            })
        }
    }
})();
