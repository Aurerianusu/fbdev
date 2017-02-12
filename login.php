<?php
    require_once __DIR__.'/vendor/autoload.php';

    $fb = new Facebook\Facebook([
        'app_id' => '276539519413614',
        'app_secret' => '93200c19ca13fa5eec70171dfb56a6e1',
        'default_graph_version' => 'v2.5',
    ]);

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_likes','public_profile','user_photos','user_birthday'];
    $loginUrl = $helper->getLoginUrl('http://localhost/fbdev/fb-callback.php', $permissions);
    if($participate){
        echo '<h1> vous participez à notre concours <span class="glyphicon glyphicon-ok" style="color: chartreuse"></span></h1>';
    }else{
        echo '<a href="' . $loginUrl . '"><img src="public/images/submit.png" id="send_button"></a></a>';
    }

