<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 14/02/2017
 * Time: 00:21
 */

require_once './dependency.php';

$db = new db();
var_dump($_POST['contestId']);die;
$db->deleteContest($_POST['contestId']);

header('Location: ./admin.php');