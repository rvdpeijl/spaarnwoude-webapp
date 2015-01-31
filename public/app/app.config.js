(function() {
    'use strict';

    angular
        .module('app')
        .run(config);

        config.$inject = ['$rootScope'];
        function config($rootScope) {
        	$rootScope.config = {
        		menuItems: [
        			{ name: 'Dashboard', slug: 'dashboard' },
        			{ name: 'Activiteiten', slug: 'activities' },
        			{ name: 'Kaart', slug: 'map' },
                    { name: 'Agenda', slug: 'agenda' },
                    { name: 'Nieuws', slug: 'news' },
                    { name: 'Over Ons', slug: 'about' },
        		],
        		social: [
        			{ name: 'Facebook', url: 'https://www.facebook.com/spaarnwoude' },
        			{ name: 'Twitter', url: 'https://twitter.com/spaarnwoude020' }
        		]
        	};
        }

})();