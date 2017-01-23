<?php

    require_once __DIR__.'/vendor/autoload.php';

    $fb = new Facebook\Facebook([
        'app_id' => '276539519413614',
        'app_secret' => '93200c19ca13fa5eec70171dfb56a6e1',
        'default_graph_version' => 'v2.5',
    ]);

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_likes','public_profile','user_photos','user_birthday']; // optional
    $loginUrl = $helper->getLoginUrl('http://localhost/fbdev/fb-callback.php', $permissions);
    echo '<a href="' . $loginUrl . '"><img src="public/images/submit.png" id="send_button"></a></a>';
