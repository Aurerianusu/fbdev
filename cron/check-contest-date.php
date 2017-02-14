<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 14/02/2017
 * Time: 23:22
 */

require_once '../db.php';

$db = new db();

$allContest = $db->getAllContest();

foreach ($allContest as $contest){

    $endDate = $contest['contest_end_date'];
    $beginDate = $contest['contest_begin_date'];

    $dateToday = date('Y/m/d H:m');
    $dateToday = new DateTime($dateToday);
    $dateToday = $dateToday->format('Y/m/d H:m');


    $beginDate = date("Y/m/d H:m", strtotime($beginDate));
    $endDate = date("Y/m/d H:m", strtotime($endDate));


    if($beginDate < $dateToday && $endDate < $dateToday ){
        $db->desactiveContest($contest['contest_id']);
    }elseif($beginDate > $dateToday && $endDate > $dateToday){
        $db->activeContest($contest['contest_id']);
    }elseif($beginDate < $dateToday && $endDate > $dateToday){
        $db->activeContest($contest['contest_id']);
    }

}
