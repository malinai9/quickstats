<?php

namespace local_quickstats\external;

use external_function_parameters;
use external_value;
use external_single_structure;
use external_multiple_structure;

defined('MOODLE_INTERNAL') || die();

class get_chart_data extends \external_api
{
    public static function execute_parameters()
    {
        return new external_function_parameters([]);
    }

    public static function execute()
    {
        global $DB;

        // Preia datele din tabelul local_quickstats.
        $records = $DB->get_records('local_quickstats', null, 'timecreated DESC', 'periodstart, activeuserscount');
        $labels = [];
        $values = [];

        foreach ($records as $record) {
            $labels[] = date('Y-m-d', $record->periodstart);
            $values[] = $record->activeuserscount;
        }

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    public static function execute_returns()
    {
        return new external_single_structure([
            'labels' => new external_multiple_structure(new external_value(PARAM_TEXT, 'Label pentru grafic')),
            'values' => new external_multiple_structure(new external_value(PARAM_INT, 'Valoare utilizatori activi')),
        ]);
    }
}
