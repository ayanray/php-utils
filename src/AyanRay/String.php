<?php

namespace AyanRay;

class String
{
    private $_str;

    public function __construct($str) {
        $this->_str = $str;
    }

    public static function c($str) {
        return new String($str);
    }

    public function __toString() {
        return $this->_str;
    }

    public function addFront($add) {
        if (substr($this->_str, 0, strlen($add)) !== $add) {
            $this->_str = $add.$this->_str;
        }
        return $this;
    }

    public function addEnd($add) {
        if (substr(strrev($this->_str), 0, strlen($add)) !== $add) {
            $this->_str = $this->_str . $add;
        }
        return $this;
    }

    public function removeFront($remove) {
        $remove_len = strlen($remove);
        if (substr($this->_str, 0, $remove_len) === $remove) {
            $this->_str = substr($this->_str, $remove_len, strlen($this->_str));
        }
        return $this;
    }

    public function removeEnd($remove)
    {
        $remove_len = strlen($remove);
        if (substr($this->_str, -$remove_len) === $remove) {
            $this->_str = substr($this->_str, 0, -$remove_len);
        }
        return $this;
    }
}