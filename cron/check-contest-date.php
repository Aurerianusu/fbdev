<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 14/02/2017
 * Time: 23:22
 */

// * 12 * * * php /var/www/fbdev/cron/check-contest-date.php
require_once '../db.php';

$db = new db();

$allContest = $db->getAllContest();

foreach ($allContest as $contest){

    $endDate = $contest['contest_end_date'];
    $beginDate = $contest['contest_begin_date'];

    $beginDate = date("Y/m/d H:m", strtotime($beginDate));
    $endDate = date("Y/m/d H:m", strtotime($endDate));

    $today = date('Y/m/d H:m');
    $today = new DateTime($today);
    $today = $today->format('Y/m/d H:m');

    if($beginDate < $today && $endDate < $today ){
        $db->desactiveContest($contest['contest_id']);
    }elseif($beginDate > $today && $endDate > $today){
        $db->activeContest($contest['contest_id']);
    }elseif($beginDate < $today && $endDate > $today){
        $db->activeContest($contest['contest_id']);
    }

}
