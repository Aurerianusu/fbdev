<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 14/02/2017
 * Time: 01:18
 */
session_start();
require_once '../db.php';
require_once '../vendor/autoload.php';
require_once './check_admin.php';
require_once './check_formulaire.php';
$db = new db();
$db->deleteTattoo($_POST['tattooId']);
header('Location: /fbdev/admin/all-tattoo.php');