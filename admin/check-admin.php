<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 14/02/2017
 * Time: 15:12
 */

$db = new db();
$fb = $db->initFb();


$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
$response = $fb->get('/me?fields=id,name,first_name,last_name,email,link,picture');
$userNode = $response->getGraphUser();

$_SESSION['email'] = $userNode->getField('email');

$adminId = $db->getAdmin($_SESSION['email']);

if(!$adminId){
    header('Location: /fbdev/not-allowed.php');
}