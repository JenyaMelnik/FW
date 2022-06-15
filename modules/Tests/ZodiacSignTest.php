<?php

use PHPUnit\Framework\TestCase;
use ZodiacSign\ZodiacSign;

class ZodiacSignTest extends TestCase
{
    /**
     * @throws Exception
     * testing class ZodiacSign
     */
    public function testGetZodiacSign(): void
    {
        include __DIR__ . '/../../library/ZodiacSign/ZodiacSign.php';

        $zodiacSign = new ZodiacSign();

        $this->assertEquals('Козерог', $zodiacSign->getZodiacSign('1986-12-22'));
        $this->assertEquals('Козерог', $zodiacSign->getZodiacSign('1986-01-19'));
        $this->assertEquals('Водолей', $zodiacSign->getZodiacSign('    1986-01-20    '));
        $this->assertEquals('Водолей', $zodiacSign->getZodiacSign('    1986-02-18    '));
        $this->assertEquals('Рыбы', $zodiacSign->getZodiacSign('1986-2-19'));
        $this->assertEquals('Рыбы', $zodiacSign->getZodiacSign('1988-02-29'));
        $this->assertEquals('Рыбы', $zodiacSign->getZodiacSign('1988-03-20'));
        $this->assertEquals('Овен', $zodiacSign->getZodiacSign('1988-03-21'));
        $this->assertEquals('Овен', $zodiacSign->getZodiacSign('1988-04-19'));
        $this->assertEquals('Телец', $zodiacSign->getZodiacSign('1988-04-20'));
        $this->assertEquals('Телец', $zodiacSign->getZodiacSign('1988-05-20'));
        $this->assertEquals('Близнецы', $zodiacSign->getZodiacSign('1988-05-21'));
        $this->assertEquals('Близнецы', $zodiacSign->getZodiacSign('1988-06-20'));
        $this->assertEquals('Рак', $zodiacSign->getZodiacSign('1988-06-21'));
        $this->assertEquals('Рак', $zodiacSign->getZodiacSign('1988-07-22'));
        $this->assertEquals('Лев', $zodiacSign->getZodiacSign('1986-07-23'));
        $this->assertEquals('Лев', $zodiacSign->getZodiacSign('1986-08-22'));
        $this->assertEquals('Дева', $zodiacSign->getZodiacSign('1986-08-23'));
        $this->assertEquals('Дева', $zodiacSign->getZodiacSign('1986-09-22'));
        $this->assertEquals('Весы', $zodiacSign->getZodiacSign('1986-09-23'));
        $this->assertEquals('Весы', $zodiacSign->getZodiacSign('1986-10-22'));
        $this->assertEquals('Скорпион', $zodiacSign->getZodiacSign('1986-10-23'));
        $this->assertEquals('Скорпион', $zodiacSign->getZodiacSign('1986-11-21'));
        $this->assertEquals('Стрелец', $zodiacSign->getZodiacSign('1986-11-22'));
        $this->assertEquals('Стрелец', $zodiacSign->getZodiacSign('1986-12-21'));
        $this->assertEquals('Не корректные данные', $zodiacSign->getZodiacSign('1986>02-29'));
        $this->assertEquals('Не корректные данные', $zodiacSign->getZodiacSign('1986-02-29'));
        $this->assertEquals('Не корректные данные', $zodiacSign->getZodiacSign('1986 -15-21'));
        $this->assertEquals('Не корректные данные', $zodiacSign->getZodiacSign('198v-15-21'));
        $this->assertEquals('Не корректные данные', $zodiacSign->getZodiacSign('1986-15-21'));
        $this->assertEquals('Не корректные данные', $zodiacSign->getZodiacSign('1986-05-50'));
        $this->assertEquals('Не корректные данные', $zodiacSign->getZodiacSign('2025-05-50'));
        $this->assertEquals('Не корректные данные', $zodiacSign->getZodiacSign('2025-05-'));
        $this->assertEquals('Не корректные данные', $zodiacSign->getZodiacSign(''));
    }
}
