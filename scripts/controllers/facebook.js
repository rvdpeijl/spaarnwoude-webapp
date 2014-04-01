app.factory('facebook', function($http, $rootScope) { 
	window.fbAsyncInit = function() {
		$('.notLoggedIn').show();
  		$('.loggedIn').hide();
		FB.init({
			appId      : '1393713924238588',
			status     : true, // check login status
			cookie     : true, // enable cookies to allow the server to access the session
			xfbml      : true  // parse XFBML
		});

		FB.Event.subscribe('auth.authResponseChange', function(response) {
			if (response.status === 'connected') {
			  userLoggedIn();

			} else if (response.status === 'not_authorized') {
			  FB.login();

			} else {
				hideLogin();
			  	FB.login();
			}
		});
	  };

	  // Load the SDK asynchronously
	  (function(d){
	   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	   if (d.getElementById(id)) {return;}
	   js = d.createElement('script'); js.id = id; js.async = true;
	   js.src = "http://connect.facebook.net/en_US/all.js";
	   ref.parentNode.insertBefore(js, ref);
	  }(document));

		function userLoggedIn() {
			$('.notLoggedIn').hide();
			$('.loggedIn').show();
			console.log('Welcome!  Fetching your information.... ');
			FB.api('/me', function(response) {
				$rootScope.facebookUserInfo = {
					voornaam : response.first_name,
					achternaam : response.last_name,
					geslacht : response.gender,
					locatie : response.locale
				}
			})
			FB.api('/me?fields=picture.width(300).height(300)', function(response) {
				$rootScope.facebookUserImages.big = response.picture.data.url	
			});
		}
		
		function hideLogin() {
			console.log('yo')
			$('.notLoggedIn').show();
			$('.loggedIn').hide();
		}
})