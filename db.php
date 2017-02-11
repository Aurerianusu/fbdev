<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 09/02/2017
 * Time: 19:00
 */
class db {
    private $conn;
    private $host;
    private $user;
    private $password;
    private $baseName;
    private $port;
    private $Debug;

    function __construct() {
        $this->conn = false;
        $this->host = 'localhost'; //hostname
        $this->user = 'root'; //username
        $this->password = ''; //password
        $this->baseName = 'pardonmaman'; //name of your database
        $this->port = '3306';
        $this->debug = true;
        $this->connect();
    }

    function __destruct() {
        $this->disconnect();
    }

    function connect() {
        if (!$this->conn) {
            try {
                $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->baseName.'', $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            }
            catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }

            if (!$this->conn) {
                $this->status_fatal = true;
                echo 'Connection BDD failed';
                die();
            }
            else {
                $this->status_fatal = false;
            }
        }

        return $this->conn;
    }

    function disconnect() {
        if ($this->conn) {
            $this->conn = null;
        }
    }

    function getOne($query) {
        $result = $this->conn->prepare($query);
        $ret = $result->execute();
        if (!$ret) {
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'error SQL: '.$query;
            die();
        }
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $reponse = $result->fetch();

        return $reponse;
    }

    function getAll($query) {
        $result = $this->conn->prepare($query);
        $ret = $result->execute();
        if (!$ret) {
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'error SQL: '.$query;
            die();
        }
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $reponse = $result->fetchAll();

        return $reponse;
    }

    function execute($query) {
        if (!$response = $this->conn->exec($query)) {
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'error SQL: '.$query;
            die();
        }
        return $response;
    }
    function getUserId($email){
        $query = "SELECT participant_id FROM participant WHERE email = '$email'";
        if(!$response = $this->conn->exec($query)){
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'error SQL: '.$query;
            die();
        }
        return $response;
    }

    function userInscription($lastName,$firstName,$email,$birthday){
        $query = "INSERT INTO participant (participant_name,participant_surname,participant_email,birthdate_participant) VALUES ('$lastName','$firstName','$email','$birthday')";
        if(!$response = $this->conn->exec($query)){
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'error SQL: '.$query;
            die();
        }
        return $response;
    }

    function uploadPicture($participantId,$contestId,$picture){
        $query = "INSERT INTO photo(participant_id,contest_id,link) VALUE ('$participantId','$contestId','$picture')";
        if(!$response = $this->conn->exec($query)){
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'error SQL: '.$query;
            die();
        }
        return $response;
    }

    function dateWithHour($date,$hour){
        $date = new DateTime($date.' '.$hour);
        return $date->format('Y-m-d H:i');
    }

    function isDateIsToday($date)
    {
        $curr_date=strtotime(date("Y-m-d H:i"));
        $the_date=strtotime($date);
        $diff=floor(($curr_date-$the_date)/(60*60*24));
        switch($diff)
        {
            case 0:
                return "Today";
                break;
            case 1:
                return "Yesterday";
                break;
            default:
                return $diff." Days ago";
        }
    }

    function dateSelected($dateNow,$dateBegin,$hourBegin){

        if(isset($dateNow)){
            unset($dateBegin);
            unset($hourBegin);
            $dateSelected = date("Y-m-d H:i:");

            return $dateSelected;
        }elseif(isset($dateBegin)&& isset($hourBegin)){
            $dateSelected = $this->dateWithHour($dateBegin,$hourBegin);

            return $dateSelected;

        }else{
            $dateSelected = date("Y-m-d H:i:");

            return $dateSelected;
        }
    }
    function createContest($contestName,$contestRules,$contestHome,$dateBegin,$dateEnd,$priceName,$pricePic){
        $today = date("Y-m-d H:i:s");
        $filePath = 'public/images/contest/'.$pricePic;
        $query = "INSERT INTO contest (contest_name,contest_rules,contest_home,contest_creation_date,contest_begin_date,contest_end_date,contest_prize,contest_image,is_active) VALUES ('$contestName','$contestRules','$contestHome','$today','$dateBegin','$dateEnd','$priceName','$filePath','1')";
        if(!$response = $this->conn->exec($query)){
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'error SQL: '.$query;
            return false;
            die();

        }else{
            return true;
        }
    }

    function uploadPrice($file){

        $target_dir = "public/images/contest/";
        $target_file = $target_dir .'/'. basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                echo "The file ". basename($file["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    function getActiveContest(){
        $contest = $this->getOne("SELECT * FROM contest WHERE  is_active = 1");
        return $contest;
    }
}