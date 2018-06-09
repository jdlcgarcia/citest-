<?php

use jdlc\citest\Hello;
use PHPUnit\Framework\TestCase;

class HelloTest extends TestCase
{

    public function testHi()
    {
        $hello = new Hello();
        $this->assertEquals("I come in peace",$hello->hi());
    }
}
