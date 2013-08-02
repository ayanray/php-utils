<?php

class TestString extends PHPUnit_Framework_TestCase
{
    public function testRemoveFromFront()
    {
        $this->assertEquals("gitignore", AyanRay\String::c(".gitignore")->removeFront(".")); // simple

        $this->assertEquals(".gitignore", AyanRay\String::c("..gitignore")->removeFront(".")); // only 1

        $this->assertEquals("test", AyanRay\String::c("test")->removeFront(".")); // not found

        $this->assertEquals("", AyanRay\String::c("")->removeFront("_")); // empty
    }

    public function testRemoveFromEnd()
    {
        $this->assertEquals("folder", AyanRay\String::c("folder/")->removeEnd("/")); // simple

        $this->assertEquals("folder/", AyanRay\String::c("folder//")->removeEnd("/")); // only 1

        $this->assertEquals("folder", AyanRay\String::c("folder")->removeEnd("/")); // not found

        $this->assertEquals("", AyanRay\String::c("")->removeEnd("_")); // empty
    }

    public function testAddToFront()
    {
        $this->assertEquals("/folder", AyanRay\String::c("folder")->addFront("/")); // simple

        $this->assertEquals("/folder", AyanRay\String::c("/folder")->addFront("/")); // should be same

        $this->assertEquals("//folder", AyanRay\String::c("//folder")->addFront("/")); // should be same repeats

        $this->assertEquals("/", AyanRay\String::c("")->addFront("/")); // empty
    }

    public function testAddToEnd()
    {
        $this->assertEquals("folder/", AyanRay\String::c("folder")->addEnd("/")); // simple

        $this->assertEquals("folder/", AyanRay\String::c("folder/")->addEnd("/")); // should be same

        $this->assertEquals("folder//", AyanRay\String::c("folder//")->addEnd("/")); // should be same repeats

        $this->assertEquals("/", AyanRay\String::c("")->addEnd("/")); // empty
    }
}
