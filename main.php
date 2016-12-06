<!DOCTYPE html>
<html>
<head>
    <title>Se connecter à FB</title>
        
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