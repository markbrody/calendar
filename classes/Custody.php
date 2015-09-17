<?php

class Custody
{
    const START_DATE = '2015-08-19';

    public static function offset($date=null) {
        $date = is_null($date) ? date('Y-m-d') : $date;
        if (strtotime($date) > strtotime(self::START_DATE)) {
            $start = new DateTime(self::START_DATE);
            $end = new DateTime($date);
            $diff = $start->diff($end);
            return $diff->days;
        }
        else
            return false;
    }

    public static function classname($offset) {
        $modulo = intval($offset) % 4;
        switch ($modulo) {
            case 0:
                $classname = 'arrive';
                break;
            case 1:
                $classname = 'home';
                break;
            case 2:
                $classname = 'depart';
                break;
            default:
                $classname = 'away';
        }

        if ($offset === false)
            $classname = '';

        return $classname;
    }

}

