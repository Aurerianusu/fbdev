<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 07/02/2017
 * Time: 16:07
 */
require_once './dependency.php';

$db = new db();
$fb = $db->initFb();

$token = $fb->getDefaultAccessToken();
$url = 'https://www.facebook.com/logout.php?next='.
    '&access_token='.$token;
session_destroy();
header('Location: '.$url);