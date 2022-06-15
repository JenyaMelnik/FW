<?php

namespace ZodiacSign;

use DateTime;
use Exception;

class ZodiacSign
{
    /** @var string */
    private string $month = '';
    /** @var string */
    private string $day = '';
    /** @var string */
    private string $zodiacSign = '';

    /**
     * @param string $birthday
     * @return string returns the zodiac sign according to the entered birthday
     * @throws Exception
     */
    public function getZodiacSign(string $birthday): string
    {
        try {
            $this->validateEnteredData($birthday);
            $this->dayNumberToZodiacSign();
        } catch (Exception $e) {
            $this->zodiacSign = 'Не корректные данные';
        }

        return $this->zodiacSign;
    }

    /**
     * @param $birthday
     * @throws Exception
     */
    private function validateEnteredData($birthday): void
    {
        $birthday = trim($birthday);
        if (!preg_match('#^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$#u', $birthday)) {
            throw new Exception('Не корректные данные');
        }

        list($year, $this->month, $this->day) = explode('-', $birthday);

        if (!checkdate($this->month, $this->day, $year)) {
            throw new Exception('Не корректные данные');
        }

        $now = new DateTime();
        $myBirthday = new DateTime($birthday);

        if ($myBirthday > $now) {
            throw new Exception('Не корректные данные');
        }
    }

    /**
     * @param int $dayNumber
     */
    private function dayNumberToZodiacSign(): void
    {
        if (($this->month == 3 && $this->day > 20) || ($this->month == 4 && $this->day < 20)) {
            $this->zodiacSign = 'Овен';
        } elseif (($this->month == 4 && $this->day > 19) || ($this->month == 5 && $this->day < 21)) {
            $this->zodiacSign = 'Телец';
        } elseif (($this->month == 5 && $this->day > 20) || ($this->month == 6 && $this->day < 21)) {
            $this->zodiacSign = 'Близнецы';
        } elseif (($this->month == 6 && $this->day > 20) || ($this->month == 7 && $this->day < 23)) {
            $this->zodiacSign = 'Рак';
        } elseif (($this->month == 7 && $this->day > 22) || ($this->month == 8 && $this->day < 23)) {
            $this->zodiacSign = 'Лев';
        } elseif (($this->month == 8 && $this->day > 22) || ($this->month == 9 && $this->day < 23)) {
            $this->zodiacSign = 'Дева';
        } elseif (($this->month == 9 && $this->day > 22) || ($this->month == 10 && $this->day < 23)) {
            $this->zodiacSign = 'Весы';
        } elseif (($this->month == 10 && $this->day > 22) || ($this->month == 11 && $this->day < 22)) {
            $this->zodiacSign = 'Скорпион';
        } elseif (($this->month == 11 && $this->day > 21) || ($this->month == 12 && $this->day < 22)) {
            $this->zodiacSign = 'Стрелец';
        } elseif (($this->month == 12 && $this->day > 21) || ($this->month == 1 && $this->day < 20)) {
            $this->zodiacSign = 'Козерог';
        } elseif (($this->month == 1 && $this->day > 19) || ($this->month == 2 && $this->day < 19)) {
            $this->zodiacSign = 'Водолей';
        } elseif (($this->month == 2 && $this->day > 18) || ($this->month == 3 && $this->day < 21)) {
            $this->zodiacSign = 'Рыбы';
        }
    }
}
