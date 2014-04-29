app.filter('timefilter', function() {
	'use strict';

	return function(input) {
		
		return input.replace(/:00$/, '');
	};
});