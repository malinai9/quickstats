<?php
defined('MOODLE_INTERNAL') || die();

$settings = new admin_settingpage('local_quickstats', get_string('pluginname', 'local_quickstats'));

$settings->add(new admin_setting_configcheckbox(
    'local_quickstats/enabled',
    get_string('enabled', 'local_quickstats'),
    get_string('enabled_desc', 'local_quickstats'),
    0
));

$settings->add(new admin_setting_configtext(
    'local_quickstats/activedays',
    get_string('activedays', 'local_quickstats'),
    get_string('activedays_desc', 'local_quickstats'),
    7,
    PARAM_INT
));

$ADMIN->add('localplugins', $settings);
