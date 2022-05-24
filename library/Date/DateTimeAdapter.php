<?php

namespace Date;

class DateTimeAdapter
{
    /** @var false|string */
    public string $date = '';

    /** @var bool */
    public bool $modified = false;

    /**
     * DateTimeAdapter constructor.
     */
    public function __construct()
    {
        $this->date = date('d-m-Y');
    }

    /**
     * @param string $modify
     */
    public function modify(string $modify): void
    {
        $myDate = new MyDate();
        $this->date = $myDate->getNextDay();
        $this->modified = true;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function format(): string
    {
        $dateElements = ($this->modified)
            ? explode(" ", $this->date)
            : explode("-", $this->date);

        $day = $dateElements[0];
        $month = $dateElements[1];
        $year = $dateElements[2];

        switch ($month) {
            case 'января':
                $month = 1;
                break;
            case 'февраля':
                $month = 2;
                break;
            case 'марта':
                $month = 3;
                break;
            case 'апреля':
                $month = 4;
                break;
            case 'мая':
                $month = 5;
                break;
            case 'июня':
                $month = 6;
                break;
            case 'июля':
                $month = 7;
                break;
            case 'августа':
                $month = 8;
                break;
            case 'сентября':
                $month = 9;
                break;
            case 'октября':
                $month = 10;
                break;
            case 'ноября':
                $month = 11;
                break;
            case 'декабря':
                $month = 12;
                break;
            default:

        }
        $date = $year . '-' . $month . '-' . $day;

        $dateTime = new \DateTime($date);

        return $dateTime->format('d-m-Y');
    }
}