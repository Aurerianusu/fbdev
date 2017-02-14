<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 11/02/2017
 * Time: 19:36
 */

define('__ROOT__', dirname(dirname(__FILE__)));
require_once __DIR__.'/vendor/autoload.php';
require (__ROOT__.'/fbdev/db.php');
session_start();

$db = new db();

$fb = $db->initFb();
$helper = $fb->getRedirectLoginHelper();

$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
$response = $fb->get('/me?fields=id,name,first_name,last_name,email,gender,link,birthday,location,picture');
$userNode = $response->getGraphUser();

$firstName = $userNode->getFirstName();
$lastName = $userNode->getLastName();
$birthday = $userNode->getBirthday();
if($birthday){
    $birthday = $birthday->format('Y/m/d h:m:s');
}
$email = $userNode->getField('email');
$profile_pic =  $userNode->getPicture();
$profile_pic = $profile_pic->getUrl();

//$profile_pic = "http://graph.facebook.com/".$userNode->getId()."/picture?width=200";

$linkMonImage = $_POST['linkTatoo'];
$participant = $db->getUser($email);
$participantId = $participant['participant_id'];
$contest= $db->getActiveContest();
$contestId = $contest['contest_id'];

if($participantId){

    $db->uploadPicture($participantId,$contestId,$linkMonImage);
}
else{

    $db->userInscription($lastName,$firstName,$email,$birthday);

    $participant = $db->getUser($email);
    $participantId = $participant['participant_id'];

    $db->uploadPicture($participantId,$contestId,$linkMonImage);

}
header('Location: ./success.php');