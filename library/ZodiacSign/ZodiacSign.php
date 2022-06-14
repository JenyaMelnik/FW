<?php

namespace ZodiacSign;

use DateTime;
use Exception;

class ZodiacSign
{
    /** @var int */
    private int $dayNumber = 0;
    /** @var string */
    private string $zodiacSign = '';

    /**
     * @param string $birthday
     * @return string returns the zodiac sign according to the entered birthday
     * @throws Exception
     */
    public function getZodiacSign(string $birthday): string
    {
        $this->validateEnteredData($birthday);
        $this->dayNumberToZodiacSign($this->dayNumber);

        if ($this->zodiacSign) {
            return $this->zodiacSign;
        } else {
            return 'Неизвестная ошибка';
        }
    }

    /**
     * @param $birthday
     * @throws Exception
     */
    private function validateEnteredData($birthday): void
    {
        $birthday = trim($birthday);
        if (!preg_match('#^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$#u', $birthday)) {
            echo 'Не корректные данные';
            exit();
        }

        $birthdayArray = explode('-', $birthday);

        $year = $birthdayArray[0];
        $month = $birthdayArray[1];
        $day = $birthdayArray[2];

        if (!checkdate($month, $day, $year)) {
            echo 'Не корректные данные';
            exit();
        }

        if ((int)($year) < 1900) {
            echo 'Не верный год рождения';
            exit();
        }

        $now = new DateTime();
        $myBirthday = new DateTime($birthday);

        if ($myBirthday > $now) {
            echo 'Не корректные данные';
            exit();
        }

        $this->dayNumber = $myBirthday->format('z') + 1;
    }

    /**
     * @param int $dayNumber
     */
    private function dayNumberToZodiacSign(int $dayNumber): void
    {
        if (($dayNumber > 0 && $dayNumber < 20) || $dayNumber > 355) {
            $this->zodiacSign = 'Козерог';
        } elseif ($dayNumber > 19 && $dayNumber < 51) {
            $this->zodiacSign = 'Водолей';
        } elseif ($dayNumber > 50 && $dayNumber < 78) {
            $this->zodiacSign = 'Рыбы';
        } elseif ($dayNumber > 77 && $dayNumber < 111) {
            $this->zodiacSign = 'Овен';
        } elseif ($dayNumber > 110 && $dayNumber < 140) {
            $this->zodiacSign = 'Телец';
        } elseif ($dayNumber > 139 && $dayNumber < 172) {
            $this->zodiacSign = 'Близнецы';
        } elseif ($dayNumber > 171 && $dayNumber < 203) {
            $this->zodiacSign = 'Рак';
        } elseif ($dayNumber > 202 && $dayNumber < 235) {
            $this->zodiacSign = 'Лев';
        } elseif ($dayNumber > 234 && $dayNumber < 266) {
            $this->zodiacSign = 'Дева';
        } elseif ($dayNumber > 234 && $dayNumber < 296) {
            $this->zodiacSign = 'Весы';
        } elseif ($dayNumber > 295 && $dayNumber < 326) {
            $this->zodiacSign = 'Скорпион';
        } elseif ($dayNumber > 325 && $dayNumber < 356) {
            $this->zodiacSign = 'Стрелец';
        }
    }
}
