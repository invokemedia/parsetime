<?php

if (! function_exists('parse_time')) {

    /**
     * Parse a sentence for time
     *
     * @param string $text
     *
     * @return string|array
     */
    function parse_time($text)
    {
        $matches = [];

        preg_match_all('/(\d{1,2}[\:]?(\d{1,2})?)\s?(am|pm)?/i', $text, $matches);

        $matches = array_slice($matches, 0, 2);

        if (empty($matches[0])) {
            return false;
        }

        $results = array_map(function ($match) {
            if (isset($match[1])) {
                return [
                    date_parse(trim($match[0])),
                    date_parse(trim($match[1])),
                ];
            }

            return date_parse(trim($match[0]));
        }, $matches);

        $results = array_slice($results, 0, 2);

        // $results = array_map(function ($result) {
        //     $is_nested = isset($result[0][0]);
        //     $result = ($is_nested) ? $result: [$result];

        //     if (empty($result[0])) {
        //         return $result;
        //     }

        //     // var_dump($result);
        //     // die();

        //     for ($i = 0; $i < count($result); $i++) {
        //         $period = ($result[$i]['hour'] > 12) ? 'PM': 'AM';
        //         $result[$i]['period'] = $period;
        //     }

        //     return ($is_nested) ? $result: $result[0];
        // }, $results);

        return isset($results[0]) ? $results[0] : $results;
    }
}
