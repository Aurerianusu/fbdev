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
        $config = parse_ini_file("config.ini");
        $this->conn = false;
        $this->host = $config['host']; //hostname
        $this->user = $config['user']; //username
        $this->password = $config['password']; //password
        $this->baseName = $config['dbname']; //name of your database
        $this->port = $config['port'];
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
            $this->redirectError();
        }

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $reponse = $result->fetch();

        return $reponse;
    }

    function getAll($query) {
        $result = $this->conn->prepare($query);
        $ret = $result->execute();

        if (!$ret) {
            $this->redirectError();
        }

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $reponse = $result->fetchAll();

        return $reponse;
    }

    function execute($query) {
        if (!$response = $this->conn->exec($query)) {

            $this->redirectError();
        }
        return $response;
    }

    function initFb(){
        $config = parse_ini_file("config.ini");

        $fb = new Facebook\Facebook([
            'app_id' => $config['app_id'],
            'app_secret' => $config['app_secret'],
            'default_graph_version' => $config['default_graph_version'],
            'status' => $config['status']
        ]);

        return $fb;
    }

    function getUser($email){

        $user = $this->getOne("SELECT * FROM participant WHERE participant_email = '$email'");
        return $user;
    }

    function userInscription($lastName,$firstName,$email){
        $query = "INSERT INTO participant (participant_name,participant_surname,participant_email) VALUES ('$lastName','$firstName','$email')";
        if(!$response = $this->conn->exec($query)){

            $this->redirectError();
        }
        return $response;
    }

    function uploadPicture($participantId,$contestId,$picture){
        $query = "INSERT INTO photo(participant_id,contest_id,link) VALUE ('$participantId','$contestId','$picture')";
        if(!$response = $this->conn->exec($query)){

            $this->redirectError();
        }
        return $response;
    }

    function createContest($contestName,$contestRules,$contestHome,$dateBegin,$dateEnd,$priceName,$pricePic,$is_active){
        $today = date("Y-m-d H:i:s");
        $filePath = 'public/images/contest/'.$pricePic;

        $query = "INSERT INTO contest (contest_name,contest_rules,contest_home,contest_creation_date,contest_begin_date,contest_end_date,contest_prize,contest_image,is_active) VALUES ('$contestName','$contestRules','$contestHome','$today','$dateBegin','$dateEnd','$priceName','$filePath','$is_active')";
        if(!$response = $this->conn->exec($query)){

            $this->redirectError();
            return false;

        }else{
            return true;
        }

    }

    function checkUploadFile($file){

        $target_dir = "../public/images/contest/";
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"]);
            if($check !== false) {
                echo "<li>File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "<li>Le fichier n'est pas une image";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<li>Désolé, le fichier existe déjà";
            $uploadOk = 0;
        }
        // Check file size
        if ($file["size"] > 500000) {
            echo "<li>Désolé, le fichier est trop lourd";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg"
            && $imageFileType != "png"
            && $imageFileType != "jpeg"
            && $imageFileType != "jpg"
            && $imageFileType != "gif"
            && $imageFileType != "PNG"
            && $imageFileType != "JPEG"
            && $imageFileType != "JPG"
            && $imageFileType != "GIF" ) {
            echo "<li>Désolé, seulement les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
            $uploadOk = 0;
        }
        return $uploadOk;
    }

    function uploadFile($uploadOk,$file){

        $target_dir = "../public/images/contest/";
        $target_file = $target_dir . basename($file["name"]);

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<li>Désolé votre fichier n'a pas été envoyé";
            return false;
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                //echo "The file ". basename($file["name"]). " a été envoyé !.";
                return true;
            } else {
                echo "<li>Désolé il y a eu une error lors de l'envoie de votre fichier";
                return false;
            }
        }
    }
    function getActiveContest(){
        $contest = $this->getOne("SELECT * FROM contest WHERE  is_active = 1");

        return $contest;
    }

    function checkIfParticipate($email){
        if (isset($email)) {
            $user = $this->getUser($email);
            $userId = $user['participant_id'];
            $contest = $this->getActiveContest();
            $contestId = $contest['contest_id'];

            $ifParticipate = $this->getOne("SELECT facebook_photos_id FROM photo WHERE participant_id = '$userId' AND contest_id = '$contestId'");

            if ($ifParticipate) {

                return true;
            } else {

                return false;
            }
        }else{

            return false;
        }
    }

    function checkIfParticipateAndRedirection($email){
        $participate = $this->checkIfParticipate($email);
        if($participate){

            header('Location: nope.php');

            return true;

        }else{

            return false;
        }
    }

    function getAllTattoo(){
        $allTattoo = $this->getAll("SELECT * FROM photo");

        return $allTattoo;
    }

    function getTatooActiveContestLimit($contestId){

        $tatoo = $this->getAll("SELECT link FROM photo WHERE contest_id = '$contestId' ORDER BY likes DESC LIMIT 5");

        return $tatoo;
    }

    function getUserTattoo($email){
        $userTattoo = $this->getOne("
                SELECT
                photo.link,
                participant.participant_surname
                FROM photo, participant
                WHERE
                photo.participant_id = participant.participant_id
                AND participant.participant_email = '$email'
                ORDER BY photo.facebook_photos_id DESC ");

        return $userTattoo;
    }

    function getTatooActiveContestWithUser(){

        $tatoo = $this->getAll("
                SELECT
                photo.link,
                photo.participant_id,
                participant.participant_id,
                participant.participant_surname
                FROM photo,participant
                WHERE photo.participant_id = participant.participant_id");

        return $tatoo;
    }

    function getAllTattooWithInfo(){
        $allTattooWithInfo = $this->getAll("
                SELECT 
                participant.participant_email, 
                participant.participant_name, 
                participant.participant_surname, 
                participant.participant_id,
                photo.link,
                photo.facebook_photos_id,
                contest.contest_id,
                contest.contest_name
                FROM photo,participant,contest
                WHERE photo.participant_id = participant.participant_id AND photo.contest_id = contest.contest_id
                ");
        return $allTattooWithInfo;
    }

    function getAllContest(){
        $allContest = $this->getAll("SELECT * FROM contest");

        return $allContest;
    }

    function deleteContest($contestId){

        $this->execute("DELETE FROM contest WHERE contest_id ='$contestId'");
    }

    function deleteTattoo($tattooId){

        $this->execute("DELETE FROM photo WHERE facebook_photos_id ='$tattooId'");
    }

    function getAdmin($email){

        $adminId = $this->getOne("SELECT admin_id FROM admin WHERE admin_email = '$email'");

        return $adminId;

    }

    function addAdmin($name,$surname,$email){
        $query = "INSERT INTO admin VALUES ('$name','$surname','$email')";
        if(!$response = $this->conn->exec($query)){

            $this->redirectError();

            return false;
        }else{

            return true;
        }
    }

    function redirectError(){

        header('Location: error.php');
    }
}