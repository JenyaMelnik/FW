<?php

use PHPUnit\Framework\TestCase;

class testZodiacSign extends TestCase
{
    public function checkValues($var1, $var2): bool
    {
        if ($var1 !== $var2) {
            echo 'Error';
            exit();
        }
        return true;
    }
}
