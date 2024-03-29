<?php
require_once "../../config.php";
require_once("../dao/CourseDAO.php");

include '../tool-config.php';

use \Tsugi\Core\LTIX;
use \Course\DAO\CourseDAO;

// Retrieve the launch data if present
$LAUNCH = LTIX::requireData();

$p = $CFG->dbprefix;

header('Content-Type: application/json');
ini_set('max_execution_time', '3600');

$real_weeks = isset($tool['api']['real_weeks']) ? ($tool['api']['real_weeks'] == '1') : false;
$real_weeks = ($LAUNCH->ltiRawParameter('custom_real_week_no','false') == "true") | $real_weeks;

$course_obj = new CourseDAO($PDOX, $p, $tool['api']['url'], $tool['api']['username'], $tool['api']['password'], $real_weeks);

$SITE_ID = $LAUNCH->ltiRawParameter('custom_site', $LAUNCH->ltiRawParameter('context_id','none'));
if (isset($tool['api']['site'])) {
    $SITE_ID = $tool['api']['site'];
}

$real = 0;
$start = 0;
$end = 0;

if (isset($_POST['real'])) {
    $real = $_POST['real'];
}
if (isset($_POST['start'])) {
    $start = $_POST['start'];
}
if (isset($_POST['end'])) {
    $end = $_POST['end'];
}

echo json_encode($course_obj->getWeek($SITE_ID, 'all', $real, $start, $end));
exit;