<?php 

class Calendar
{
    private $year;
    private $month;
    private $unixtime;
    private $num_days;
    private $start_day;
    public $today;
    public $title;
    public $offset;
    public $previous;
    public $next;
    public $days;

    public function __construct($year=null, $month=null) {

        $year = intval($year) > 2015 ? $year : date('Y');
        $month = intval($month) > 0 ? $month : date('n');
        $month_start = "$month/1/$year";

        $this->year = $year;
        $this->month = $month;
        $this->unixtime = strtotime($month_start);
        $this->num_days = date('t', $this->unixtime);
        $this->start_day = date('w', $this->unixtime);
        $this->today = $this->year . $this->month == date('Yn') ? date('j') : 0;
        $this->title = date('M Y', $this->unixtime);
        $this->offset = Custody::offset($month_start);
        $this->previous = $this->prev_month();
        $this->next = $this->next_month();
        $this->days = $this->build();
    }

    private function prev_month() {
        $previous = array();
        $previous['year'] = $this->year;
        $previous['month'] = $this->month - 1;
        if ($previous['month'] == 0) {
            $previous['year'] = $this->year - 1;
            $previous['month'] = 12;
        }
        return $previous;
    }

    private function next_month() {
        $next = array();
        $next['year'] = $this->year;
        $next['month'] = $this->month + 1;
        if ($next['month'] == 13) {
            $next['year'] = $this->year + 1;
            $next['month'] = 1;
        }
        return $next;
    }

    private function build() {
        $calendar = array();
        for ($x=0; $x<$this->start_day; ++$x)
            $calendar[] = null;
        for ($x=1; $x<=$this->num_days; ++$x)
            $calendar[] = $x;
        return $calendar;
    }

}

