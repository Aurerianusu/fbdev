<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 09/02/2017
 * Time: 19:00
 */
class db {
    /**
     * @var bool
     */
    private $conn;
    /**
     * @var
     */
    private $host;
    /**
     * @var
     */
    private $user;
    /**
     * @var
     */
    private $password;
    /**
     * @var
     */
    private $baseName;
    /**
     * @var
     */
    private $port;
    /**
     * @var
     */
    private $Debug;

    /**
     * db constructor.
     */
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

    /**
     *
     */
    function __destruct() {
        $this->disconnect();
    }

    /**
     * @return bool|PDO
     */
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

    /**
     *
     */
    function disconnect() {
        if ($this->conn) {
            $this->conn = null;
        }
    }

    /**
     * @param $query
     * @return mixed
     */
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

    /**
     * @param $query
     * @return mixed
     */
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

    /**
     * @param $query
     * @return mixed
     */
    function execute($query) {
        if (!$response = $this->conn->exec($query)) {

            $this->redirectError();
        }
        return $response;
    }

    /**
     * @return \Facebook\Facebook
     */
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

    /**
     * @param $email
     * @return mixed
     */
    function getUser($email){

        $user = $this->getOne("SELECT * FROM participant WHERE participant_email = '$email'");
        return $user;
    }

    /**
     * @param $lastName
     * @param $firstName
     * @param $email
     */
    function userInscription($lastName, $firstName, $email){

        $query = "INSERT INTO participant (participant_name,participant_surname,participant_email) VALUES ('$lastName','$firstName','$email')";
        if(!$response = $this->conn->exec($query)){

            $this->redirectError();
        }
    }

    /**
     * @param $participantId
     * @param $contestId
     * @param $picture
     * @return mixed
     */
    function uploadPicture($participantId, $contestId, $picture){
        $query = "INSERT INTO photo(participant_id,contest_id,link) VALUE ('$participantId','$contestId','$picture')";
        if(!$response = $this->conn->exec($query)){

            $this->redirectError();
        }
        return $response;
    }

    /**
     * @param $contestName
     * @param $contestRules
     * @param $contestHome
     * @param $dateBegin
     * @param $dateEnd
     * @param $priceName
     * @param $pricePic
     * @param $is_active
     * @return bool
     */
    function createContest($contestName, $contestRules, $contestHome, $dateBegin, $dateEnd, $priceName, $pricePic, $is_active){
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

    /**
     * @param $file
     * @return int
     */
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

    /**
     * @param $uploadOk
     * @param $file
     * @return bool
     */
    function uploadFile($uploadOk, $file){

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

    /**
     * @return mixed
     */
    function getActiveContest(){
        $contest = $this->getOne("SELECT * FROM contest WHERE is_active = 1");

        return $contest;
    }

    /**
     * @return mixed
     */
    function getAllContest(){

        $allContest = $this->getAll("SELECT * FROM contest");

        return $allContest;
    }

    /**
     * @param $email
     * @return bool
     */
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

    /**
     * @param $email
     * @return bool
     */
    function checkIfParticipateAndRedirection($email){
        $participate = $this->checkIfParticipate($email);
        if($participate){

            header('Location: nope.php');

            return true;

        }else{

            return false;
        }
    }

    /**
     * @return mixed
     */
    function getAllTattoo(){
        $allTattoo = $this->getAll("SELECT * FROM photo");

        return $allTattoo;
    }

    /**
     * @param $contestId
     * @return mixed
     */
    function getTatooActiveContestLimit($contestId){

        $tatoo = $this->getAll("SELECT link,facebook_photos_id,likes FROM photo WHERE contest_id = '$contestId' ORDER BY likes DESC LIMIT 4");

        return $tatoo;
    }

    /**
     * @param $email
     * @return bool|mixed
     */
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
        if($userTattoo){
            return $userTattoo;
        }else{
            return false;
        }
    }

    /**
     * @param $email
     * @return bool|mixed
     */
    function getUserTattooActive($email){
        $userTattoo = $this->getOne("
                SELECT
                photo.link,
                participant.participant_surname
                FROM photo, participant,contest
                WHERE
                photo.participant_id = participant.participant_id
                AND photo.contest_id = contest.contest_id
                AND contest.is_active = '1'
                AND participant.participant_email = '$email'
                ORDER BY photo.facebook_photos_id DESC ");
        if($userTattoo){
            return $userTattoo;
        }else{
            return false;
        }
    }


    /**
     * @return mixed
     */
    function getTatooActiveContestWithUser(){

        $tatoo = $this->getAll("
                SELECT
                contest.is_active,
                photo.likes,
                photo.link,
                photo.facebook_photos_id,
                photo.participant_id,
                participant.participant_id,
                participant.participant_surname
                FROM photo,participant,contest
                WHERE photo.participant_id = participant.participant_id 
                AND photo.contest_id = contest.contest_id 
                AND contest.is_active = '1'
                ORDER BY likes DESC");

        return $tatoo;
    }

    /**
     * @return mixed
     */
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

    /**
     * @param $contestId
     */
    function deleteContest($contestId){
        $picture = $this->getOne("SELECT contest_image FROM contest WHERE contest_id = '$contestId'");
        $this->execute("DELETE FROM contest WHERE contest_id ='$contestId'");
        unlink('./'.$picture);
    }

    /**
     * @param $tattooId
     */
    function deleteTattoo($tattooId){

        $this->execute("DELETE FROM photo WHERE facebook_photos_id ='$tattooId'");
    }

    /**
     * @param $email
     * @return mixed
     */
    function getAdmin($email){

        $adminId = $this->getOne("SELECT admin_id FROM admin WHERE admin_email = '$email'");

        return $adminId;

    }

    /**
     * @param $name
     * @param $surname
     * @param $email
     * @return bool
     */
    function addAdmin($name, $surname, $email){
        $query = "INSERT INTO admin VALUES ('$name','$surname','$email')";
        if(!$response = $this->conn->exec($query)){

            $this->redirectError();

            return false;
        }else{

            return true;
        }
    }

    /**
     * @param $photoId
     * @param $userId
     * @return bool
     */
    function likePhoto($photoId, $userId){

        $query = "INSERT INTO likes (photo_id, user_id) VALUES ('$photoId','$userId')";
        if (!$response = $this->conn->exec($query)) {

            $this->redirectError();
            return false;

        } else {
            return true;
        }
    }

    /**
     * @param $photoId
     * @return bool
     */
    function addLike($photoId){

        $query = "UPDATE photo SET likes= likes +1 WHERE facebook_photos_id = '$photoId'";
        if (!$response = $this->conn->exec($query)) {

            $this->redirectError();
            return false;

        } else {
            return true;
        }
    }

    /**
     * @param $photoId
     * @param $userId
     * @return mixed
     */
    function ifUserAllreadyLikes($photoId, $userId){

        $allReadyLike = $this->getOne("SELECT like_id FROM likes WHERE user_id = '$userId' AND photo_id = '$photoId'");

        return $allReadyLike;
    }

    /**
     * @param $contestId
     */
    function activeContest($contestId){

        $query = "UPDATE contest SET is_active = '1' WHERE contest_id = '$contestId'";
        $this->conn->exec($query);
    }

    /**
     * @param $contestId
     */
    function desactiveContest($contestId){
        $query = "UPDATE contest SET is_active = 0 WHERE contest_id = '$contestId'";

        $this->conn->exec($query);
    }

    /**
     *
     */
    function redirectError(){

        header('Location: error.php');
    }

}