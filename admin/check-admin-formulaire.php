<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 14/02/2017
 * Time: 15:40
 */

$error = FALSE;
$msg_error = "";

$db = new db();

if( isset($_POST['name']) &&  isset($_POST['surname']) &&  isset($_POST['email']))
{

    if(strlen($_POST['name']) < 2)
    {
        $error = TRUE;
        $msg_error .= "<li>Le nom doit faire plus de deux caractères";
    }

    if(strlen($_POST['surname']) < 2)
    {
        $error = TRUE;
        $msg_error .= "<li>Le prenom doit faire plus de deux caractères";
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $error = TRUE;
        $msg_error .= "<li>L'email n'est pas valide";
    }

}

if($error) {
    echo "<ul>";
    echo $msg_error;
    echo "</ul>";
}else {
    if(isset($_POST['save'])){

        $db->addAdmin($_POST['name'],$_POST['surname'],$_POST['email']);

        header('Location: /fbdev/admin/success-add-admin.php');
    }
}