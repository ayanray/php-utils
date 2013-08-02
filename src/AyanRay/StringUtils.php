<?php

namespace AyanRay;

class StringUtils
{
    public static function removeFromBeginning($needle, $haystack) {
        $to_return = $haystack;
        $needle_len = strlen($needle);
        if (substr($haystack, 0, $needle_len) === $needle) {
            $to_return = substr($haystack, $needle_len, strlen($haystack));
        }

        return $to_return;
    }

    public static function removeFromEnd($needle, $haystack) {
        $to_return = $haystack;
        $needle_len = strlen($needle);
        if (substr($haystack, -$needle_len) === $needle) {
            $to_return = substr($haystack, 0, -$needle_len);
        }

        return $to_return;
    }



}