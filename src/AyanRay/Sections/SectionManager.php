<?php

namespace AyanRay\Sections;

/**
 * The SectionManager enforces ID uniqueness
 * and allows you to fetch sections by ID, className, and other useful manager-related
 * functions.
 */
class SectionManager {

   /**
    * Actual container for section objects (even if they are just pointers).
    *
    * @var Section[]
    */
   private static $__sections = array();

   /**
    * The official register section function. Section on instantiation calls this function
    * so that you don't have to. All sections should be registered with this manager.
    * If you care about overriding this, message me or fork + Singleton it / change it.
    *
    * @param Section $section
    *
    * @return bool
    */
   public static function registerSection(Section $section) {
      $uid = $section->getUID();
      if (isset(self::$__sections[$uid])) {
         return false;
      }
      self::$__sections[$uid] = $section;
      return true;
   }

   /**
    * @param $id
    *
    * @return bool
    */
   public static function sectionExists($id) {
      $section = SectionManager::getSection($id);
      return !empty($section);
   }

   /**
    * @param $id
    *
    * @return Section|null
    */
   public static function getSection($id) {
      return isset(self::$__sections[$id]) ? self::$__sections[$id] : null;
   }

   /**
    * Get all section IDs
    *
    * @return string[]
    */
   public static function getSectionIDs() {
      return array_keys(self::$__sections);
   }

   /**
    * Use a class name like "BasicSection" to get all sections of that type
    *
    * @param string $class_name
    *
    * @return Section[]
    */
   public static function getSectionsByClassName($class_name) {
      $sections = array();
      foreach (self::$__sections as $section) {
         if (get_class($section) == $class_name) {
            $sections[] = $section;
         }
      }
      return $sections;
   }
}