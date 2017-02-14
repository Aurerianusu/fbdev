<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 14/02/2017
 * Time: 16:31
 */

session_start();
require_once '../db.php';
require_once '../vendor/autoload.php';

$db = new db();
$fb = $db->initFb();

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes','public_profile','user_photos',];

$loginAdminUrl = $helper->getLoginUrl('http://localhost/fbdev/admin/fb-callback-admin.php', $permissions);

header('Location: '.$loginAdminUrl);