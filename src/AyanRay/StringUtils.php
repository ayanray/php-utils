<?php

namespace AyanRay;

class StringUtils
{
    public static function removeFromBeginning($remove, $from) 
    {
        $remove_len = strlen($remove);
        if (substr($from, 0, $remove_len) === $remove) {
            return substr($from, $remove_len, strlen($from));
        }
        return $from;
    }

    public static function removeFromEnd($remove, $from) 
    {
        $remove_len = strlen($remove);
        if (substr($from, -$remove_len) === $remove) {
            return substr($from, 0, -$remove_len);
        }
        return $from;
    }



}