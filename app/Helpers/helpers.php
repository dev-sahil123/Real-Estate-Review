<?php

function pre($str) {
    echo '<pre>';
    print_r($str);
    echo '</pre>';
}

function pred($str) {
    echo '<pre>';
    print_r($str);
    echo '</pre>';
    die;
}

if (!function_exists('htmlOptionsToKeyValueArray')) {
    function htmlOptionsToKeyValueArray($htmlOptions)
    {
        $optionsArray = [];

        preg_match_all('/<option value="([^"]+)">([^<]+)<\/option>/', $htmlOptions, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $optionsArray[strtolower($match[1])] = $match[2];
        }

        return $optionsArray;
    }
}

if (!function_exists('getSuburbs')) {
    function getSuburbs() {
        return [
            'sydney' => 'Sydney',
            'eastern_suburbs' => 'Eastern Suburbs',
            'balmain' => 'Balmain',
            'parramatta' => 'Parramatta',
            'mosman' => 'Mosman',
            'surry_hills' => 'Surry Hills',
            'marrickville, new south wales' => 'Marrickville, New South Wales',
            'coogee' => 'Coogee',
            'glebe' => 'Glebe',
            'randwick' => 'Randwick',
            'lane_cove' => 'Lane Cove',
            'blacktown' => 'Blacktown',
            'cronulla' => 'Cronulla',
            'manly' => 'Manly',
            'north_sydney' => 'North Sydney',
            'double bay' => 'Double Bay',
            'vaucluse' => 'Vaucluse',
            'bondi' => 'Bondi',
            'redfern' => 'Redfern',
            'newtown' => 'Newtown',
            'paddington' => 'Paddington',
            'darlinghurst' => 'Darlinghurst',
            'bellevue_hill' => 'Bellevue Hill',
            'chippendale' => 'Chippendale',
            'maroubra' => 'Maroubra',
        ];
    }
}