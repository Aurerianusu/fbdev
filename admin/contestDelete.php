<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 14/02/2017
 * Time: 00:21
 */
session_start();
require_once '../db.php';
require_once '../vendor/autoload.php';
require_once './check_admin.php';
require_once './check_formulaire.php';
$db = new db();
$db->deleteContest($_POST['contestId']);
header('Location: /fbdev/admin/admin.php');