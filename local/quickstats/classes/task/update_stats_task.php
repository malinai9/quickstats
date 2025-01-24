<?php

namespace local_quickstats\task;

use core\task\scheduled_task;

defined('MOODLE_INTERNAL') || die();

/**
 * Task to update active user statistics for the QuickStats plugin.
 */
class update_stats_task extends scheduled_task
{
    /**
     * Returns the name of the scheduled task.
     *
     * @return string
     */
    public function get_name()
    {
        return get_string('updatestatstask', 'local_quickstats');
    }

    /**
     * Executes the task to calculate and store active user statistics.
     */
    public function execute()
    {
        global $DB;

        // Check if the plugin is enabled in the settings.
        $enabled = get_config('local_quickstats', 'enabled');
        if (!$enabled) {
            mtrace('QuickStats plugin is disabled. Skipping task execution.');
            return;
        }

        // Get the number of days for active users from the settings.
        $activedays = (int) get_config('local_quickstats', 'activedays');
        if ($activedays <= 0) {
            mtrace('Invalid active days setting. Skipping task execution.');
            return;
        }

        // Calculate the timestamp range for active users.
        $now = time();
        $periodstart = $now - ($activedays * 24 * 60 * 60);

        // Query the database to count active users.
        $sql = "
            SELECT COUNT(DISTINCT u.id) AS activeusers
              FROM {user} u
              JOIN {user_lastaccess} ula ON ula.userid = u.id
             WHERE ula.timeaccess >= :periodstart
               AND u.deleted = 0
               AND u.suspended = 0
               AND u.confirmed = 1
        ";

        $params = ['periodstart' => $periodstart];
        $activeuserscount = $DB->get_field_sql($sql, $params);

        // Insert the data into the local_quickstats table.
        $record = new \stdClass();
        $record->activeuserscount = $activeuserscount;
        $record->periodstart = $periodstart;
        $record->periodend = $now;
        $record->timecreated = $now;

        $DB->insert_record('local_quickstats', $record);

        // Log the result for debugging purposes.
        mtrace("QuickStats task executed: $activeuserscount active users recorded.");
    }
}
