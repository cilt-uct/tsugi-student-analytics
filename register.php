<?php

$REGISTER_LTI2 = array(
    "name" => "Student Analytics"
    ,"FontAwesome" => "fa-chart-bar"
    ,"short_name" => "Student Analytics"
    ,"description" => "Shows a breakdown of student activity over the weeks that the course is active, needs access to a Learning Warehouse that stores the student activity classification."
    ,"messages" => array("launch") // By default, accept launch messages..
    ,"privacy_level" => "public" // anonymous, name_only, public
    ,"license" => "Apache"
    ,"languages" => array(
        "English",
    )
    ,"analytics" => array(
        "internal"
    )
    ,"source_url" => "https://github.com/cilt-uct/tsugi-student-analytics"
    // For now Tsugi tools delegate this to /lti/store
    ,"placements" => array(
        /*
        "course_navigation", "homework_submission",
        "course_home_submission", "editor_button",
        "link_selection", "migration_selection", "resource_selection",
        "tool_configuration", "user_navigation"
        */
    )
    ,"screen_shots" => array(
        /* no screenshots */
    )
);