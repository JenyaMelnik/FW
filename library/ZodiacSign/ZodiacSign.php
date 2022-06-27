<?php

namespace ZodiacSign;

use DateTime;
use Exception;

enum Zodiacs: string
{
    case Aquarius = "Водолей";
    case Pisces = 'Рыбы';
    case Aries = 'Овен';
    case Taurus = 'Телец';
    case Gemini = 'Близнецы';
    case Cancer = 'Рак';
    case Leo = 'Лев';
    case Virgo = 'Дева';
    case Libra = 'Весы';
    case Scorpio = 'Скорпион';
    case Sagittarius = 'Стрелец';
    case Capricorn = 'Козерог';
}

enum Errors: string
{
    case IncorrectData = 'Не корректные данные';
    case IncorrectBirthday = 'Вы еще не родились';
}

class ZodiacSign
{
    /** @var string */
    private string $month = '';
    /** @var string */
    private string $day = '';
    /** @var string */
    public string $zodiacSign = '';

    /**
     * @param string $birthday
     * @return string
     */
    public function getZodiacSign(string $birthday): string
    {
        try {
            $this->validateEnteredData($birthday);
            $this->dayNumberToZodiacSign();
        } catch (Exception $e) {
            $this->zodiacSign = $e->getMessage();
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
            throw new Exception(Errors::IncorrectData->value);
        }

        list($year, $this->month, $this->day) = explode('-', $birthday);

        if (!checkdate($this->month, $this->day, $year)) {
            throw new Exception(Errors::IncorrectData->value);
        }

        $now = new DateTime();
        $myBirthday = new DateTime($birthday);

        if ($myBirthday > $now) {
            throw new Exception(Errors::IncorrectBirthday->value);
        }
    }

    /**
     *
     */
    private function dayNumberToZodiacSign(): void
    {
        if (($this->month == 3 && $this->day > 20) || ($this->month == 4 && $this->day < 20)) {
            $this->zodiacSign = Zodiacs::Aries->value;
        } elseif (($this->month == 4 && $this->day > 19) || ($this->month == 5 && $this->day < 21)) {
            $this->zodiacSign = Zodiacs::Taurus->value;
        } elseif (($this->month == 5 && $this->day > 20) || ($this->month == 6 && $this->day < 21)) {
            $this->zodiacSign = Zodiacs::Gemini->value;
        } elseif (($this->month == 6 && $this->day > 20) || ($this->month == 7 && $this->day < 23)) {
            $this->zodiacSign = Zodiacs::Cancer->value;
        } elseif (($this->month == 7 && $this->day > 22) || ($this->month == 8 && $this->day < 23)) {
            $this->zodiacSign = Zodiacs::Leo->value;
        } elseif (($this->month == 8 && $this->day > 22) || ($this->month == 9 && $this->day < 23)) {
            $this->zodiacSign = Zodiacs::Virgo->value;
        } elseif (($this->month == 9 && $this->day > 22) || ($this->month == 10 && $this->day < 23)) {
            $this->zodiacSign = Zodiacs::Libra->value;
        } elseif (($this->month == 10 && $this->day > 22) || ($this->month == 11 && $this->day < 22)) {
            $this->zodiacSign = Zodiacs::Scorpio->value;
        } elseif (($this->month == 11 && $this->day > 21) || ($this->month == 12 && $this->day < 22)) {
            $this->zodiacSign = Zodiacs::Sagittarius->value;
        } elseif (($this->month == 12 && $this->day > 21) || ($this->month == 1 && $this->day < 20)) {
            $this->zodiacSign = Zodiacs::Capricorn->value;
        } elseif (($this->month == 1 && $this->day > 19) || ($this->month == 2 && $this->day < 19)) {
            $this->zodiacSign = Zodiacs::Aquarius->value;
        } elseif (($this->month == 2 && $this->day > 18) || ($this->month == 3 && $this->day < 21)) {
            $this->zodiacSign = Zodiacs::Pisces->value;
        }
    }
}
