<?php

/** custom taskhub config */

return [

    /*
    |--------------------------------------------------------------------------
    | Project status labels
    |-------------------------------------------------------------------------- 
    */

    'project_status_labels' => [
        'completed' => "success",
        "onhold" => "warning",
        "ongoing" => "info",
        "started" => "primary",
        "cancelled" => "danger"
    ],

    'task_status_labels' => [
        'completed' => "success",
        "onhold" => "warning",
        "started" => "primary",
        "cancelled" => "danger",
        "ongoing" => "info"
    ],

    'role_labels' => [
        'admin' => "info",
        "Super Admin" => "danger",
        "HR" => "primary",
        "member" => "warning"
    ],

    'priority_labels' => [
        'low' => "success",
        "high" => "danger",
        "medium" => "warning"
    ],
];
