<?php

if (! function_exists('parse_time')) {

    /**
     * Parse a sentence for time
     *
     * @param string $text
     * @param bool $replace_words
     *
     * @return string|array
     */
    function parse_time($text, $replace_words = false)
    {
        $matches = [];

        if ($replace_words) {
            $text = strtolower($text);
            $phrases = [
                '0:00' => 'midnight',
                '12:00' => 'noon',
                '12:00' => 'midday',
            ];

            foreach ($phrases as $key => $phrase) {
                $text = str_replace($phrase, $key, $text);
            }
        }

        preg_match_all('/(\d{1,2}[\:]?(\d{1,2})?\s?(am|pm)?)/i', $text, $matches);

        $matches = array_slice($matches[0], 0, 2);

        if (empty($matches[0])) {
            return false;
        }

        $results = array_map(function ($match) {
            if (is_array($match)) {
                return [
                    date_parse(trim($match[0])),
                    date_parse(trim($match[1])),
                ];
            }

            return date_parse(trim($match));
        }, $matches);

        $results = array_map(function ($result) {
            $is_nested = isset($result[1]);
            $items = ($is_nested) ? $result: [$result];

            for ($i = 0; $i < count($items); $i++) {
                $items[$i]['period'] = ($items[$i]['hour'] > 12) ? 'PM': 'AM';
            }

            return ($is_nested) ? $items: $items[0];
        }, $results);

        return (isset($results[1])) ? $results : $results[0];
    }
}
