<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 07/02/2017
 * Time: 16:07
 */
session_start();
require_once __DIR__.'./db.php';
require_once __DIR__.'/vendor/autoload.php';
$db = new db();
$fb = $db->initFb();

$token = $fb->getDefaultAccessToken();
$url = 'https://www.facebook.com/logout.php?next='.
    '&access_token='.$token;
session_destroy();
header('Location: '.$url);