<?php

class contest
{
    public function databaseConnect()
    {
        require 'conf.php';
        try {
            return new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME . ';charset=utf8', DBUSER, DBPWD); //Constants are defined in the conf.php file
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getContest()
    {
        $connect = $this->databaseConnect();
        return $connect-> query('SELECT * FROM contest');
    }

    public function displayContest()
    {
        $contestInformation = $this->getContest();
        while($data = $contestInformation->fetch())
        {
            ?>
            Contest ID : <?php echo $data['contest_id']; ?> <br />
            Contest name : <?php echo $data['contest_name']; ?> <br />
            Contest creation date : <?php echo $data['contest_creation_date']; ?> <br />
            Contest begin date : <?php echo $data['contest_begin_date']; ?> <br />
            Contest end date : <?php echo $data['contest_end_date']; ?> <br />
            Contest prize : <?php echo $data['contest_prize']; ?> <br />
            Contest status : <?php echo $data['is_active']; ?> <br />
            Contest winner name : <?php echo $data['winner_participant_id']; ?> <br />
            Contest winner image  : <?php echo $data['winner_image_id']; ?> <br />
            <?php
        }
    }

    public function addContest()
    {
        $connect = $this->databaseConnect();
        $newContest = $connect->prepare('INSERT INTO contest (contest_name, contest_begin_date, contest_end_date, contest_prize, is_active) VALUES (:contest_name, :contest_begin_date, :contest_end,date, :contest_prize, :is_active)');
        $newContest->execute(array(
            'contest_name' => $_POST['contest_name'],
            'contest_begin_date' => $_POST['contest_begin_date'],
            'contest_end_date' => $_POST['contest_end_date'],
            'contest_prize' => $_POST['contest_prize'],
            'is_active' => '1'
        ));
        echo 'Contest has been successfully created';
    }

    public function checkIfContestFormIsFilled()
    {
        if (isset($_POST['contest_name']) && isset($_POST['contest_begin_date']) && isset($_POST['contest_end_date']) && isset($_POST['contest_prize'])){
            $this->addContest();
        }
    }

    public function displayContestForm()
    {
        require 'contestForm.html';
    }
}

$contest = new contest();
$contest-> displayContestForm();
$contest->displayContest();

?>