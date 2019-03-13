<?php

use jdlc\citest\Fibonacci;
use PHPUnit\Framework\TestCase;

class FibonacciTestTest extends TestCase
{

    public function testBaseCase0()
    {
        $fibonacho = new Fibonacci();
        $this->assertEquals(0, $fibonacho->getN(0));
    }

    public function testBaseCase1()
    {
        $fibonacho = new Fibonacci();
        $this->assertEquals(1, $fibonacho->getN(1));
    }

    public function testRegularCase()
    {
        $fibonacho = new Fibonacci();
        $this->assertEquals(1, $fibonacho->getN(2));
    }

    public function testLongCase()
    {
        $fibonacho = new Fibonacci();
        $this->assertEquals(55, $fibonacho->getN(10));
    }
}
