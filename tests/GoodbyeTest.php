<?php


use jdlc\citest\Goodbye;
use PHPUnit\Framework\TestCase;

class GoodbyeTest extends TestCase
{
    public function testGoodbye()
    {
        $farewell = new Goodbye();
        $this->assertEquals("bye!", $farewell->bye());
    }

    public function testRidiculo()
    {
        $farewell = new Goodbye();
        $this->assertEquals("bye bye mi picolísima dama!", $farewell->byeRidiculo());
    }
}