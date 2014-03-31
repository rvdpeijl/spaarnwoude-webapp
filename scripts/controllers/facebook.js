app.factory('facebook', function($http, $rootScope) { 
	var facebook = []
	facebook.getUser = 
	window.fbAsyncInit = function() {
		$('.notLoggedIn').show();
  		$('.loggedIn').hide();
	  FB.init({
	    appId      : '1393713924238588',
	    status     : true, // check login status
	    cookie     : true, // enable cookies to allow the server to access the session
	    xfbml      : true  // parse XFBML
	  });

	  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
	  // for any authentication related change, such as login, logout or session refresh. This means that
	  // whenever someone who was previously logged out tries to log in again, the correct case below 
	  // will be handled. 
	  FB.Event.subscribe('auth.authResponseChange', function(response) {
	    // Here we specify what we do with the response anytime this event occurs. 
	    if (response.status === 'connected') {
	      // The response object is returned with a status field that lets the app know the current
	      // login status of the person. In this case, we're handling the situation where they 
	      // have logged in to the app.
	      userLoggedIn();
	    } else if (response.status === 'not_authorized') {
	      // In this case, the person is logged into Facebook, but not into the app, so we call
	      // FB.login() to prompt them to do so. 
	      // In real-life usage, you wouldn't want to immediately prompt someone to login 
	      // like this, for two reasons:
	      // (1) JavaScript created popup windows are blocked by most browsers unless they 
	      // result from direct interaction from people using the app (such as a mouse click)
	      // (2) it is a bad experience to be continually prompted to login upon page load.
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