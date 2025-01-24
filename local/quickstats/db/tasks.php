<?php
defined('MOODLE_INTERNAL') || die();

$tasks = [
    [
        'classname' => 'local_quickstats\task\update_stats_task',
        'blocking' => 0,
        'minute' => '0',
        'hour' => '2',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    ],
];
