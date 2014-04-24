    app.factory('facebook', function($http) { 
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
                  $('.loader').animate({opacity: 1});
                  userLoggedIn();
                  $rootScope.fbLoggedIn = true;

                } else if (response.status === 'not_authorized') {
                  FB.login();
                  $rootScope.fbLoggedIn = false;

                } else {
                    hideLogin();
                    FB.login();
                    $rootScope.fbLoggedIn = false;
                    $('.loguit').animate({opacity: 0});
                    $('.notLoggedIn').animate({opacity: 1});
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
                $('.loader').fadeIn();
                $('.loggedIn').show();

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

                $('.notLoggedIn').show();
                $('.loggedIn').hide();
            }

            function login() {
                FB.login();
            }
    }) 