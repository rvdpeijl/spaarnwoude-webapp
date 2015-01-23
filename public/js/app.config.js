(function() {
    'use strict';

    angular
        .module('app')
        .run(config);

        function config($rootScope) {
        	$rootScope.config = {
        		menuItems: [
        			{ name: 'Dashboard', slug: 'dashboard' },
        			{ name: 'Activiteiten', slug: 'activities' },
        			{ name: 'Kaart', slug: 'map' },
        		],
        		social: [
        			{ name: 'Facebook', url: 'https://www.facebook.com/spaarnwoude' },
        			{ name: 'Twitter', url: 'https://twitter.com/spaarnwoude020' }
        		]
        	};
        }

})();