<?php

function getExportMonth($month, $year)
{
    if ($month == 'all')
    {
        $from = date('d/m/Y', strtotime('Jan 1 '.$year));
        $to = date('d/m/Y', strtotime('Dec 31 '.$year));
    }
    else
    {
        // Use mktime() and date() function to convert number to month name
        $month_name = date("F", mktime(0, 0, 0, $month, 10));
        $from = date('01/m/Y', strtotime($month_name.' '.$year));
        $to = date('t/m/Y', strtotime($month_name.' '.$year));
    }
    return [
        'from'  =>  $from,
        'to'    =>  $to,
    ];
}
