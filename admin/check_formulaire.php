<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 10/02/2017
 * Time: 23:54
 */

$error = FALSE;
$msg_error = "";


$db = new db();

if(!isset($_POST['dateNow'])){
    $_POST['dateNow'] = '';
}
if(isset($_POST['dateNow'])){

    unset($_POST['dateBegin']);
    unset($_POST['hourBegin']);
    $dateSelected = date("Y-m-d H:i:s");

}elseif(isset($_POST['dateBegin'])&& isset($_POST['hourBegin'])){
    $dateSelected = $db->dateWithHour($_POST['dateBegin'],$_POST['hourBegin']);

}else{
    $dateSelected = date("Y-m-d H:i:s");

}

if(isset($_POST['dateEnd']) && isset($_POST['hourEnd'])){
    $dateEnd = new DateTime($_POST['dateEnd'].' '.$_POST['hourEnd']);
    $dateEnd =  $dateEnd->format('Y-m-d H:i');
}

if( isset($_POST['title']) &&  isset($_POST['price']) &&  isset($_FILES['fileToUpload']) &&  isset($_POST['home']) && isset($_POST['rules']) &&  isset($dateSelected) && isset($dateEnd) )
{


    if(strlen($_POST['title']) < 2)
    {
        $error = TRUE;
        $msg_error .= "<li>Le titre doit faire plus d'un caractère";
    }

    if(strlen($_POST['price']) < 2)
    {
        $error = TRUE;
        $msg_error .= "<li>Le nom du prix doit faire plus d'un caractère";
    }

    if( $_POST['title'] === $_POST['price'])
    {
        $error = TRUE;
        $msg_error .= "<li>Le titre doit être différent du nom du prix";
    }

    if(strlen($_POST['home']) < 20 )
    {
        $error = TRUE;
        $msg_error .= "<li>La présentation du concours doit faire plus de 20 caractères";
    }
    if(strlen($_POST['rules']) < 10 )
    {
        $error = TRUE;
        $msg_error .= "<li>Les règles du concours doivent faire plus de 10 caractères";
    }
    if (!DateTime::createFromFormat('Y-m-d H:i:s', $dateSelected))
    {
        $error = TRUE;
        $msg_error .= "<li>La date n'est pas valide";
    }

    if(strtotime($dateEnd) < strtotime($dateSelected))
    {
        $error = TRUE;
        $msg_error .= "<li>La date de fin doit être après la date de début";
    }
    if($_FILES['fileToUpload']['name'] == '')
    {
        $error = TRUE;
        $msg_error .= "<li>Vous devez choisir une photo pour le prix";
    }
    $file = $db->uploadPrice($_FILES['fileToUpload']);

}

if($error) {

    echo "<ul>";
    echo $msg_error;
    echo "</ul>";
}else {
    if(isset($_POST['save']) && isset($file) && $file == true){
        $creation = $db->createContest($_POST['title'],$_POST['rules'],$_POST['home'],$dateSelected,$dateEnd,$_POST['price'],$_FILES['fileToUpload']['name']);
        header('Location: index.php');
    }

}