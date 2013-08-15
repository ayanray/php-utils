<?php

class TestString extends PHPUnit_Framework_TestCase {

   public function testRemoveFromFront() {
      $this->assertEquals("gitignore", AyanRay\String::c(".gitignore")->removeFront("."));
      $this->assertEquals(
         ".gitignore", AyanRay\String::c("..gitignore")->removeFront(".")
      );
      $this->assertEquals(
         "test", AyanRay\String::c("test")->removeFront(".")
      );
      $this->assertEquals("", AyanRay\String::c("")->removeFront("_"));
   }

   public function testRemoveFromEnd() {
      $this->assertEquals(
         "folder", AyanRay\String::c("folder/")->removeEnd("/")
      );
      $this->assertEquals(
         "folder/", AyanRay\String::c("folder//")->removeEnd("/")
      );
      $this->assertEquals(
         "folder", AyanRay\String::c("folder")->removeEnd("/")
      );
      $this->assertEquals("", AyanRay\String::c("")->removeEnd("_"));
   }

   public function testAddToFront() {
      $this->assertEquals(
         "/folder", AyanRay\String::c("folder")->addFront("/")
      );
      $this->assertEquals(
         "/folder", AyanRay\String::c("/folder")->addFront("/")
      );
      $this->assertEquals(
         "//folder", AyanRay\String::c("//folder")->addFront("/")
      );
      $this->assertEquals("/", AyanRay\String::c("")->addFront("/"));
   }

   public function testAddToEnd() {
      $this->assertEquals("folder/", AyanRay\String::c("folder")->addEnd("/"));
      $this->assertEquals(
         "folder/", AyanRay\String::c("folder/")->addEnd("/")
      );
      $this->assertEquals(
         "folder//", AyanRay\String::c("folder//")->addEnd("/")
      );
      $this->assertEquals("/", AyanRay\String::c("")->addEnd("/"));
   }

   public function testMisc() {
      $this->assertEquals(8, AyanRay\String::c("test 123")->length());
      $this->assertEquals(0, AyanRay\String::c("")->length());
      $this->assertEquals(1, AyanRay\String::c("\n")->length());
      $this->assertEquals(0, AyanRay\String::c("\n")->charCount());
      $this->assertEquals(
         3, AyanRay\String::c("hello hello hello")->substrCount
         (
            "hello"
         )
      );
      $this->assertEquals(
         1, AyanRay\String::c("Hello Hello hello")->substrCount
         (
            "hello"
         )
      );
      $this->assertEquals(
         3, AyanRay\String::c("Hello Hello hello")->substrCount
         (
            "hello", false
         )
      );
      $this->assertEquals("cba", AyanRay\String::c("abc")->reverse());
      $this->assertEquals(
         "Every Good Boy Deserves Fudge",
         AyanRay\String::c("every good boy deserves fudge")
             ->capitalize()
      );

      $this->assertEquals(
         true, AyanRay\String::c("every good boy deserves fudge")->contains("fudge")
      );
   }
}
