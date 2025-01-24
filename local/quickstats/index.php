<?php
require_once('../../config.php');
require_login();
if (!is_siteadmin()) {
    throw new moodle_exception('accessdenied', 'admin');
}

$PAGE->set_url(new moodle_url('/local/quickstats/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_quickstats'));
$PAGE->set_heading(get_string('pluginname', 'local_quickstats'));
$PAGE->requires->js_call_amd('local_quickstats/chart', 'init', ['chartCanvas', $PAGE->url->out(false)]);

echo $OUTPUT->header();

echo html_writer::tag('canvas', '', ['id' => 'chartCanvas', 'width' => '400', 'height' => '200']);

echo $OUTPUT->footer();
