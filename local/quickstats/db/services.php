<?php

$functions = [
    'local_quickstats_get_chart_data' => [
        'classname'   => 'local_quickstats\external\get_chart_data',
        'methodname'  => 'execute',
        'classpath'   => '',
        'description' => 'Return data for QuickStats chart.',
        'type'        => 'read',
        'ajax'        => true,
        'capabilities' => 'moodle/site:config',
    ],
];
