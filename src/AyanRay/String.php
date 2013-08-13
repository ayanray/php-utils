<?php

namespace AyanRay;

/**
 * The String class is a useful string wrapper that provides auto-complete at a data type
 * level. Instead of having to use and remember str_replace, trim, addslashes, etc.,
 * you can just use this class and chain those commands together using autocomplete,
 * making it a little bit faster and more fun to code.
 */
class String {

   /**
    * Private native data type
    *
    * @var
    */
   private $_str;

   /**
    * @param $str
    */
   public function __construct($str) {
      $this->_str = $str;
   }

   /**
    * Create a new String class
    *
    * @param $str
    *
    * @return String
    */
   public static function c($str) {
      return new String($str);
   }

   /**
    * Returns the native data type (string) that's been operated on
    *
    * @return mixed
    */
   public function getString() {
      return $this->_str;
   }

   /**
    * Magic function used when printing/echoing/output
    *
    * @return mixed
    */
   public function __toString() {
      return $this->_str;
   }

   /**
    * Adds a string to the front of the string only if it isn't there already
    * I.e. folder > / > /folder
    *
    * @param $add
    *
    * @return String
    */
   public function addFront($add) {
      if (substr($this->_str, 0, strlen($add)) !== $add) {
         $this->_str = $add . $this->_str;
      }
      return $this;
   }

   /**
    * Adds a string to the end of the string, again, only if it's not there already
    * I.e. /folder > / > /folder/
    *
    * @param $add
    *
    * @return String
    */
   public function addEnd($add) {
      if (substr(strrev($this->_str), 0, strlen($add)) !== $add) {
         $this->_str = $this->_str . $add;
      }
      return $this;
   }

   /**
    * @param $remove
    *
    * @return String
    */
   public function removeFront($remove) {
      $remove_len = strlen($remove);
      if (substr($this->_str, 0, $remove_len) === $remove) {
         $this->_str = substr($this->_str, $remove_len, strlen($this->_str));
      }
      return $this;
   }

   /**
    * @param $remove
    *
    * @return String
    */
   public function removeEnd($remove) {
      $remove_len = strlen($remove);
      if (substr($this->_str, -$remove_len) === $remove) {
         $this->_str = substr($this->_str, 0, -$remove_len);
      }
      return $this;
   }

   /**
    * @return String
    */
   public function toLower() {
      $this->_str = strtolower($this->_str);
      return $this;
   }

   /**
    * @return String
    */
   public function toUpper() {
      $this->_str = strtoupper($this->_str);
      return $this;
   }

   /**
    * PHP's Native Strip tags
    *
    * @return String
    */
   public function stripTags($allowable_tags = null) {
      $this->_str = strip_tags($this->_str, $allowable_tags);
      return $this;
   }

   /**
    * PHP's Native Strip slashes
    *
    * @return String
    */
   public function stripSlashes() {
      $this->_str = stripslashes($this->_str);
      return $this;
   }

   /**
    * PHP's Native Strip slashes
    *
    * @return String
    */
   public function addSlashes() {
      $this->_str = addslashes($this->_str);
      return $this;
   }

   /**
    * Shorter Alias for truncate
    *
    * @param int    $len
    * @param string $add_to_end
    *
    * @return String
    */
   public function trunc($len = 250, $add_to_end = "...") {
      $this->truncate($len, $add_to_end);
      return $this;
   }

   /**
    * Shrink string down to X characters and IF it's shrinked, add a string to the end
    * I.e. I'm talking for a long time -> I'm talking for a long...
    *
    * @param int    $len
    * @param string $add_to_end
    *
    * @return String
    */
   public function truncate($len = 250, $add_to_end = "...") {
      if (strlen($this->_str) > $len) {
         $this->_str = substr($this->_str, 0, $len) . $add_to_end;
      }
      return $this;
   }

   /**
    * See PHP Documentation for wordwrap.
    * http://www.php.net/manual/en/function.wordwrap.php
    *
    * @param int    $width
    * @param string $break
    * @param bool   $cut
    *
    * @return String
    */
   public function wordWrap($width = 75, $break = "\n", $cut = false) {
      $this->_str = wordwrap($this->_str, $width, $break, $cut);
      return $this;
   }

   /**
    * PHP's Native str_replace
    *
    * @param $search
    * @param $replace
    *
    * @return String
    */
   public function replace($search, $replace) {
      $this->_str = str_replace($search, $replace, $this->_str);
      return $this;
   }

   /**
    * PHP's Native ucwords
    *
    * @return String
    */
   public function capitalize() {
      $this->_str = ucwords($this->_str);
      return $this;
   }

   /**
    * @return String
    */
   public function reverse() {
      $this->_str = strrev($this->_str);
      return $this;
   }

   /**
    * PHP's Native strlen.
    * Includes white space and hidden characters (I.e. \n => strlen of 1).
    * Use charCount if you need only character count.
    *
    * @return int
    */
   public function length() {
      return strlen($this->_str);
   }

   /**
    * @return int
    */
   public function len() {
      return $this->length();
   }

   /**
    * @return String
    */
   public function trim() {
      $this->_str = trim($this->_str);
      return $this;
   }

   /**
    * @return String
    */
   public function ltrim() {
      $this->_str = ltrim($this->_str);
      return $this;
   }

   /**
    * @return String
    */
   public function rtrim() {
      $this->_str = rtrim($this->_str);
      return $this;
   }

   /**
    * @return String
    */
   public function lineBreakToBR() {
      $this->_str = nl2br($this->_str);
      return $this;
   }

   /**
    * @param      $delim
    * @param null $limit
    *
    * @return array
    */
   public function split($delim, $limit = null) {
      return explode($delim, $this->_str, $limit);
   }

   /**
    * @return mixed
    */
   public function wordCount() {
      return str_word_count($this->_str);
   }

   /**
    * Returns character count after removing all white space
    *
    * @return int
    */
   public function charCount() {
      return strlen(preg_replace('/\s+/', '', $this->_str));
   }

   /**
    * @param      $substr
    * @param bool $case_sensitive
    *
    * @return int
    */
   public function substrCount($substr, $case_sensitive = true) {
      if (!$case_sensitive) {
         return substr_count(strtolower($this->_str), strtolower($substr));
      } else {
         return substr_count($this->_str, $substr);
      }
   }
}