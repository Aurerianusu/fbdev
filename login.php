/<!doctype>
<html>
<head>
    <title>MDR</title>
</head>
<body>
    <?php
    session_start();
    require_once __DIR__.'/vendor/autoload.php';

    $fb = new Facebook\Facebook([
        'app_id' => '276539519413614',
        'app_secret' => '93200c19ca13fa5eec70171dfb56a6e1',
        'default_graph_version' => 'v2.5',
    ]);

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_likes']; // optional
    $loginUrl = $helper->getLoginUrl('http://localhost/fbdev/fb-callback.php', $permissions);

    echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    /*
        include 'libs/facebook.php';


        $facebook = new Facebook(array(
         'appId' => '276539519413614',
         'secret' => '93200c19ca13fa5eec70171dfb56a6e1',
         'cookie' => true
        ));

        $session = $facebook->getSignedRequest();
        $me = null;

        if($session){
            try{
                $me = $facebook->api('/me');
            }catch (FacebookApiExeption $e){
                echo $e->getMessage();
            }
        }

        if($me){
            $logoutURL = $facebook->getLogoutUrl();
            echo "<a href='$logoutURL'>Logout</a>";
        }
        else{
            $loginURL = $facebook->getLoginUrl(array(

            ));
            echo "<a href='$loginURL'>Login</a>";
        }*/
    ?>
</body>
</html>
