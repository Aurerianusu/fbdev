<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 14/02/2017
 * Time: 01:18
 */
require_once './dependency.php';

$db = new db();
$db->deleteTattoo($_POST['tattooId']);
header('Location: ./all-tattoo.php');