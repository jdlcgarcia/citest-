<?php


namespace jdlc\citest;


class Fibonacci
{
    public function getN($n)
    {
        if ($n == 0) {
            return 0;
        }
        if ($n == 1) {
            return 1;
        }
        return $this->getN($n-1)+$this->getN($n-2);
    }
}