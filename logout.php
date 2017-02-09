<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 07/02/2017
 * Time: 16:07
 */
require_once __DIR__.'/vendor/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '276539519413614',
    'app_secret' => '93200c19ca13fa5eec70171dfb56a6e1',
    'default_graph_version' => 'v2.5',
]);

$token = $fb->getDefaultAccessToken();
$url = 'https://www.facebook.com/logout.php?next='.
    '&access_token='.$token;
session_destroy();
header('Location: '.$url);