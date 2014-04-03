<?php
/*

This script is licensed under Apache 2.0. View the license here:
http://www.apache.org/licenses/LICENSE-2.0.html
Copyright Reserved to g0g0l
Contact @ Skype : noc2spam
*/

class Utility {

    function placeHolders($text, $count = 0, $separator = ",") {
        $result = array();
        if ($count > 0) {
            for ($x = 0; $x < $count; $x++) {
                $result[] = $text;
            }
        }

        return implode($separator, $result);
    }

    function isMultiArray($a) {
        foreach ($a as $v)
            if (is_array($v))
                return TRUE;
        return FALSE;
    }

}
