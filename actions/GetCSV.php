<?php
require_once("../../config.php");
require_once("../dao/CourseDAO.php");

include '../tool-config.php';

use \Tsugi\Core\LTIX;
use \Course\DAO\CourseDAO;

// Retrieve the launch data if present
$LAUNCH = LTIX::requireData();

$p = $CFG->dbprefix;

ini_set('max_execution_time', '3600');

$real_weeks = isset($tool['api']['real_weeks']) ? ($tool['api']['real_weeks'] == '1') : false;
$real_weeks = ($LAUNCH->ltiRawParameter('custom_real_week_no','false') == "true") | $real_weeks;

$course_obj = new CourseDAO($PDOX, $p, $tool['api']['url'], $tool['api']['username'], $tool['api']['password'], $real_weeks);

$SITE_ID = $LAUNCH->ltiRawParameter('custom_site', $LAUNCH->ltiRawParameter('context_id','none'));
if (isset($tool['api']['site'])) {
    $SITE_ID = $tool['api']['site'];
}

$data = array('success' => 0, 'err' => 'Could not request course information.');
$data = $course_obj->getJSON($SITE_ID, true);

// echo json_encode($data);
// exit();

if ($data['success'] == 1) {
    $now = new DateTime();
    $now->setTimezone(new DateTimeZone('Africa/Johannesburg'));


    header('Cache-Control: private');
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="Analytics '. $data['title'] . ' '. $now->format('Y-m-d_H-i'). '.csv"');

    // use Keys For Header Row
    array_unshift($data['result'], array_keys(reset($data['result'])));
    
    $outputBuffer = fopen("php://output", 'w');
    foreach($data['result'] as $v) {
        fputcsv($outputBuffer, $v);
    }
    fclose($outputBuffer);
} else {
    
    $config = array();
    $config['styles']  = [ '' ];

    // Start of the output
    $OUTPUT->header();
    
    echo "<link href='static/user.css' rel='stylesheet' />";
    
    $OUTPUT->bodyStart();

    $OUTPUT->topNav(false);

    echo file_get_contents('../templates/error.html');

    $OUTPUT->footerStart();
    $OUTPUT->footerEnd();
}
exit;