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
    $permission=['email'];
    $loginurl=$helper->getLoginUrl($permission);
    echo'<a href="'.$loginurl.'">Login with Facebook!</a>';
    $_SESSION['facebook_access_token'] = (string) $accessToken;
    echo 'mdr';

    // Now you can redirect to another page and use the
    // access token from $_SESSION['facebook_access_token']
}
else{
    $fb->setDefaultAccessToken($accessToken);
    $response = $fb->get('/me');
    $userNode = $response->getGraphUser();

    echo 'Name: '.$userNode->getName().'<br>';
    echo 'User ID ' . $userNode->getId().'<br>';
    echo 'Email ' . $userNode->getProperty('email').'<br><br>';

    $image = 'https://graph.facebook.com/'.$userNode->getId().'/picture?width=200';
    echo "Picture <br>";
    echo "<img src='$image' /><br><br>";


}