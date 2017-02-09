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
    function createContest($contestName,$beginDate,$endDate,$contentPrize){
        $query = "INSERT INTO contest (contest_name, contest_creation_date, contest_begin_date, contest_end_date, contest_prize, is_active, winner_participant_id, winner_image_id) "
    }
}