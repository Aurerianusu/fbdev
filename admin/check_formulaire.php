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

if( isset($_POST['title']) &&  isset($_POST['price']) &&  isset($_FILES['fileToUpload']) &&  isset($_POST['home']) && isset($_POST['rules']) &&  isset($_POST['dateBegin']) && isset($_POST['hourBegin']) && isset($_POST['dateEnd']) && isset($_POST['hourEnd']) )
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

    $dateSelected = new DateTime($_POST['dateBegin'].' '.$_POST['hourBegin']);
    $dateSelected = $dateSelected->format('Y/m/d H:m');

    //$checkDate = $db->isDateIsBeforeToday($dateSelected);
    $dateToday = date('Y/m/d H:m');
    $dateToday = new DateTime($dateToday);

    if($dateSelected < $dateToday){
        $error = TRUE;
        $msg_error .= "<li>Voulez changer le cours du temps ? Veuillez choisir une date >= à aujourd'hui svp.";
    }elseif($dateSelected == $dateToday){
        $is_active = 1;
    }else{
        $is_active = 0;
    }

    $dateEnd = new DateTime($_POST['dateEnd'].' '.$_POST['hourEnd']);
    $dateEnd =  $dateEnd->format('Y:m:d H:m');



    if(!DateTime::createFromFormat('Y:m:d H:m', $dateSelected))
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
    $uploadOk = $db->checkUploadFile($_FILES['fileToUpload']);
}

if($error) {

    echo "<ul>";
    echo $msg_error;
    echo "</ul>";
}else {
    if(isset($_POST['save']) && isset($uploadOk) && $uploadOk == 1){
    var_dump('okmec');
    die;
        $creation = $db->createContest($_POST['title'],$_POST['rules'],$_POST['home'],$dateSelected,$dateEnd,$_POST['price'],$_FILES['fileToUpload']['name'],$is_active);

        $db->uploadFile($uploadOk,$_FILES['fileToUpload']);
        header('Location: /fbdev/admin/successadmin.php');
    }

}