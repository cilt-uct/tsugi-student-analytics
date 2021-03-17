<?php
require_once('../config.php');
include 'tool-config-dist.php';
include 'src/Template.php';


use \Tsugi\Util\U;
use \Tsugi\Core\Cache;
use \Tsugi\Core\Settings;
use \Tsugi\Core\LTIX;
use \Tsugi\Util\LTI;
use \Tsugi\UI\SettingsForm;

// Retrieve the launch data if present
$LAUNCH = LTIX::requireData();
$p = $CFG->dbprefix;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$menu = false;

$config = [
    'instructor' => $USER->instructor, 
    'styles'     => [ 'static/user.css' ],
    'scripts'    => [ $CFG->staticroot .'/js/moment.min.js'],
    'getInfoURL'        => addSession('actions/GetInfo.php'),
    'fetchWeekDataUrl'  => addSession('actions/GetWeek.php'),
    'downloadURL'       => addSession('actions/GetCSV.php'),
    'tool' => $tool
];

// Start of the output
$OUTPUT->header();

Template::view('templates/header.html', $config);

$OUTPUT->bodyStart();

$OUTPUT->topNav($menu);

if ($tool['debug']) {
    echo '<pre>'; print_r($config); echo '</pre>';
}

Template::view('templates/body.html', $config);

$OUTPUT->footerStart();

Template::view('templates/footer.html', $config);
include('templates/tmpl.html');

$OUTPUT->footerEnd();
