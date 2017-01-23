<?php
    /**
     * Created by PhpStorm.
     * User: Guigui
     * Date: 21/01/2017
     * Time: 21:30
     */
    session_start();
    require_once __DIR__.'/vendor/autoload.php';
    $fb = new Facebook\Facebook([
        'app_id' => '276539519413614',
        'app_secret' => '93200c19ca13fa5eec70171dfb56a6e1',
        'default_graph_version' => 'v2.5',
    ]);

    $redirect = 'http://localhost/fbdev/login.php';
    $helper = $fb->getRedirectLoginHelper();

    try {
        $accessToken = $helper->getAccessToken();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {

        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {

        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    if (!isset($accessToken)) {

        // Logged in!
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email', 'user_likes','public_profile']; // optional
        $loginUrl = $helper->getLoginUrl('http://localhost/fbdev/fb-callback.php', $permissions);

        echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

        $_SESSION['facebook_access_token'] = $accessToken;
        // Now you can redirect to another page and use the
        // access token from $_SESSION['facebook_access_token']
    }
    else{

        //var_dump($accessToken);
        $fb->setDefaultAccessToken($accessToken);
        $response = $fb->get('/me?fields=id,name,first_name,last_name,gender,link,birthday,location,picture');
        $userNode = $response->getGraphUser();

        $profile_pic =  "http://graph.facebook.com/".$userNode->getId()."/picture?width=200";

        echo 'Name: '.$userNode->getName().'<br>';
        echo 'User ID ' . $userNode->getId().'<br>';
        echo 'Email ' . $userNode->getField('email').'<br>';
        echo 'Genre ' . $userNode->getGender().'<br>';
        echo 'Lien du profil  <a href ='.$userNode->getLink().'>PROFIL FB</a><br>';
        echo "<img src=\"" . $profile_pic . "\" />";

        $photos_request = $fb->get('/me/photos?limit=100&type=uploaded');
        $photos = $photos_request->getGraphEdge();

        $all_photos = array();
        if ($fb->next($photos)) {
            $photos_array = $photos->asArray();
            $all_photos = array_merge($photos_array, $all_photos);
            while ($photos = $fb->next($photos)) {
                $photos_array = $photos->asArray();
                $all_photos = array_merge($photos_array, $all_photos);
            }
        } else {
            $photos_array = $photos->asArray();
            $all_photos = array_merge($photos_array, $all_photos);
        }

        foreach ($all_photos as $key) {
            $photo_request = $fb->get('/'.$key['id'].'?fields=images');
            $photo = $photo_request->getGraphNode()->asArray();
            echo '<img src="'.$photo['images'][1]['source'].'"><br>';
        }
    }