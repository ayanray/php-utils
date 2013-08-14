<?php

namespace AyanRay\Sections;

/**
 * A Section is an encapsulated area of a page that can be rendered
 * asynchronously and independent of other elements of the page.
 * By rendering them independently, you can speed up initial load times
 * but at a trade-off of more requests. Assuming you are read heavy,
 * your application should be able to handle the load.
 * Thankfully, if you are not ready to start using async-loading,
 * you can just turn it off.
 *
 * Note: It is abstract because I don't assume any particular rendering method.
 * You are expected to extend it with something (my implementation is BasicSection)
 * and then override the internal protected rendering function to render your section.
 */
abstract class Section {

   /**
    * Every Section could have a title
    *
    * @var string
    */
   public $title = "Section Header";
   /**
    * Defaults to use async loading
    *
    * @var bool
    */
   public $async = true;
   /**
    * Default behavior is only once because it's easy to
    * add a section to multiple parents and potentially get
    * circular dependencies. You can easily override this default
    * behavior in your implementation.
    *
    * @var bool
    */
   public $render_only_once = true;
   /**
    * Load itself before loading the children.
    *
    * @var bool
    */
   public $load_children_first = false;
   /**
    * @var mixed
    */
   private $_id;
   /**
    * @var Section[]
    */
   protected $_children = array();
   /**
    * @var int
    */
   private $_render_count = 0;

   /**
    * You can pass it new Section("My title") or new Section("my_id", "My Title");
    * So you give it a unique ID and a title to refer to it by.
    *
    * @param string $id_or_title
    * @param string $title
    */
   public function __construct($id_or_title, $title = null) {
      $id = $id_or_title;
      $this->_id = $this->_generateSafeID($id);
      $this->title = $title !== null ? $title : $id_or_title;
      SectionManager::registerSection($this);
   }

   /**
    * Override how I make ID's if necessary
    *
    * @param $id
    *
    * @return mixed
    */
   protected function _generateSafeID($id) {
      $id = strtolower(str_replace(" ", "_", $id));
      $id = preg_replace("/[^A-Za-z0-9_]/", '', $id);
      return $id;
   }

   /**
    * Bulk set children, set the id, or any other property on the object.
    * You can only set the children or ID if they are currently empty.
    * Useful for creating by Reflection.
    *
    * @param $name
    * @param $value
    *
    * @throws \ErrorException
    */
   public function __set($name, $value) {
      if ($name == "id") {
         if (empty($this->_id)) {
            $this->_id = $value;
         }
      } else if ($name == "children") {
         if (empty($this->_children)) {
            $this->_children = $value;
            foreach ($this->_children as $child) {
               if (!($child instanceof Section)) {
                  throw new \ErrorException("One or more children are not an instance of Section");
               }
            }
         }
      } else {
         if (property_exists($this, $name)) {
            $this->$name = $value;
         }
      }
   }

   /**
    * The unique ID of the section
    *
    * @return mixed
    */
   public function getUID() {
      return $this->_id;
   }

   /**
    * @return int
    */
   public function getRenderCount() {
      return $this->_render_count;
   }

   /**
    * @param Section $child
    *
    * @throws \ErrorException
    */
   public function addChild(Section $child) {
      if (empty($child)) {
         return;
      }
      if (!($child instanceof Section)) {
         throw new \ErrorException("Cannot add child that is not a Section");
      }
      if ($child->getUID() == $this->getUID()) {
         throw new \ErrorException("Cannot add section with same id to itself!");
      }
      // Keep only a reference of the UID. UIDs are unique across all sections (enforced)
      $this->_children[] = $child->getUID();
   }

   /**
    * Get the children as sections or section IDs
    *
    * @param bool $as_sections
    *
    * @return Section[]|string[]
    */
   public function getChildren($as_sections = false) {
      if ($as_sections) {
         $sections = array();
         foreach ($this->_children as $section_id) {
            $section = SectionManager::getSection($section_id);
            if (!empty($section)) {
               $sections[] = $section;
            }
         }
         return $sections;
      } else {
         return $this->_children;
      }
   }

   /**
    * @return int
    */
   public function numChildren() {
      return count($this->_children);
   }

   /**
    * Useful if you want to turn async off for all children but load the current
    * section asynchronously. You can do it vice versa too and load the current section
    * synchronously and the children asynchronously.
    *
    * @param bool $async
    * @param bool $recurse Recursively on all children?
    */
   public function setAsyncOnChildren($async = true, $recurse = false) {
      $children = $this->getChildren(true);
      foreach ($children as $child) {
         $child->async = $async;
         if ($recurse) {
            $child->setAsyncOnChildren($async, true);
         }
      }
   }

   public function render() {
      if ($this->getRenderCount() > 0 && $this->render_only_once) {
         return;
      }
      if (!$this->load_children_first) {
         $this->_render();
      }
      $children = $this->getChildren(true);
      foreach ($children as $child) {
         $child->render();
      }
      if ($this->load_children_first) {
         $this->_render();
      }
      $this->_render_count++;
   }

   /**
    * Override this function to render the section
    */
   protected function _render() {
   }
}