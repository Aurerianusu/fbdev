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

        $user = $db->getUser($_SESSION['email']);

        if($user){

            $userId = $user['participant_id'];
        }else{

            $db->userInscription($lastName,$firstName,$_SESSION['email']);
            $user = $db->getUser($_SESSION['email']);
            $userId = $user['participant_id'];
        }

        $allreadyLike = $db->ifUserAllreadyLikes($_GET['id'],$userId);

        if(!$allreadyLike){

            $db->likePhoto($_GET['id'],$userId);
            $db->addLike($_GET['id']);
            if($_GET['goto'] == 'galerie'){

                header('Location: galerie.php');
            }else{
                header('Location: index.php');
            }

        }else{
            ?>
        <script>
            alert('Vous aimez déjà la photo');
            document.location.href="<?php echo $_GET['goto'];?>.php"
        </script>
            <?php

        }

    }else{

        header('Location: error.php');
    }
}else{
    header('Location: connect-like.php?goto=like&id='.$_GET['id']);
}

