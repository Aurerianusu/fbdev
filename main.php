<!DOCTYPE html>
<html>
<head>
    <title>Se connecter à FB</title>
        <script type="text/javascript" src="public/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="public/js/script.js">
        <script>
            function statusChangeCallback(response) {
                console.log('statusChangeCallback');
                console.log(response);
                // The response object is returned with a status field that lets the
                // app know the current login status of the person.
                // Full docs on the response object can be found in the documentation
                // for FB.getLoginStatus().
                if (response.status === 'connected') {
                    // Logged into your app and Facebook.
                    testAPI();
                } else if (response.status === 'not_authorized') {
                    // The person is logged into Facebook, but not your app.
                    document.getElementById('status').innerHTML = 'Please log ' +
                        'into this app.';
                } else {
                    // The person is not logged into Facebook, so we're not sure if
                    // they are logged into this app or not.
                    document.getElementById('status').innerHTML = 'Please log ' +
                        'into Facebook.';
                }
            }

            // This function is called when someone finishes with the Login
            // Button.  See the onlogin handler attached to it in the sample
            // code below.
            function checkLoginState() {
                FB.getLoginStatus(function(response) {
                    statusChangeCallback(response);
                });
            }

            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '276539519413614',
                    xfbml      : true,
                    version    : 'v2.8'
                });
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/fr_FR/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });

            function testAPI() {
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me', function(response) {
                    console.log('Successful login for: ' + response.name);
                    document.getElementById('status').innerHTML =
                        'Thanks for logging in, ' + response.name + '!';
                });
            }
        </script>
</head>
<body>

    <div
        class="fb-like"
        data-share="true"
        data-width="450"
        data-show-faces="true">
    </div>

    <br/><br/>

    <!-- OLD VERSION OF THE BUTTON, THE OTHER ONE HAS AN OPTION TO CHECK IF THE USER IS CONNECTED. IF YES, THE DISCONNECT BUTTON DISPLAYS -->
    <!--<fb:login-button scope="public_profile" onlogin="checkLoginState();">
    </fb:login-button>-->

    <div class="fb-login-button" scope="public_profile" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="true"></div>
</body>