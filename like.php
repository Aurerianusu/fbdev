<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 14/02/2017
 * Time: 19:29
 */
session_start();
require_once './vendor/autoload.php';
require_once './db.php';

$db = new db();
if($_SESSION['facebook_access_token']){

    $fb = $db->initFb();
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    $response = $fb->get('/me?fields=id,name,first_name,last_name,email,link,picture');
    $userNode = $response->getGraphUser();

    $firstName = $userNode->getFirstName();
    $lastName = $userNode->getLastName();

    $_SESSION['email'] = $userNode->getField('email');

    if($_GET['id']){

        $db = new db();

        $user = $db->searchUser($_SESSION['email']);
        if($user){
            $userId = $user['user_id'];
        }else{

            $db->createUser($lastName,$firstName,$_SESSION['email']);
            $user = $db->searchUser($_SESSION['email']);
            $userId = $user['user_id'];
        }
        $db->likePhoto($_GET['id'],$userId);
        header('Location: index.php');
    }else{

        header('Location: error.php');
    }
}else{
    header('Location: connect-like.php?goto=like&id='.$_GET['id']);
}

