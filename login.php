<?php

    require_once __DIR__.'./db.php';
    require_once __DIR__.'/vendor/autoload.php';

    $db = new db();
    $fb = $db->initFb();

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_likes','public_profile','user_photos','user_birthday'];
    $loginUrl = $helper->getLoginUrl('http://localhost/fbdev/fb-callback.php', $permissions);

    $contest = $db->getActiveContest();

    if($contest){
        if($participate){
            echo '<h1> vous participez à notre concours <span class="glyphicon glyphicon-ok" style="color: chartreuse"></span></h1>';
        }else{
            echo '<a href="' . $loginUrl . '"><img src="public/images/submit.png" id="send_button"></a></a>';
        }
    }else{
        echo '<h2>Il n\'y a actuellement aucun concours</h2>';
        echo '<h2>Suivez la page PardonMaman pour être informé du prochain concours !</h2>';
    }


