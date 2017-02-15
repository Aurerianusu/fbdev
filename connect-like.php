<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 14/02/2017
 * Time: 19:34
 */
require_once './dependency.php';

$db = new db();
$fb = $db->initFb();

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes','public_profile','user_photos'];
$loginUrl = $helper->getLoginUrl('http://localhost/fbdev/fb-callback.php?goto='.$_GET['goto'].'&id='.$_GET['id'], $permissions);

header('Location: '.$loginUrl);