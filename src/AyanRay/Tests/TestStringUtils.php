<?php

class TestStringUtils extends PHPUnit_Framework_TestCase
{
    public function testRemoveFromBeginning()
    {
        $this->assertEquals("gitignore", AyanRay\StringUtils::removeFromBeginning(".", ".gitignore")); // simple

        $this->assertEquals(".gitignore", AyanRay\StringUtils::removeFromBeginning(".", "..gitignore")); // only 1

        $this->assertEquals("test", AyanRay\StringUtils::removeFromBeginning(".", "test")); // not found

        $this->assertEquals("", AyanRay\StringUtils::removeFromBeginning("_", "")); // empty
    }

    public function testRemoveFromEnd()
    {
        $this->assertEquals("folder", AyanRay\StringUtils::removeFromEnd("/", "folder/")); // simple

        $this->assertEquals("folder/", AyanRay\StringUtils::removeFromEnd("/", "folder//")); // only 1

        $this->assertEquals("folder", AyanRay\StringUtils::removeFromEnd("/", "folder")); // not found

        $this->assertEquals("", AyanRay\StringUtils::removeFromEnd("_", "")); // empty
    }
}
