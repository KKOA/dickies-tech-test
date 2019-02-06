<?php
/*
Description :Write payroll date for the current year to file.
Author : Keith Amoah
Date : 24/01/2018
*/


require_once('CsvGenerator.php');
$filename = null;
if(isset($argv[1]))
{
  /* Allows user to specify the file they wish to read from by passing it as the second argument in command prompt.
 When not stated, use default filename. */
  $filename = $argv[1];
}

function is_weekend($mydate)
{// Return true if date falls on saturday or sunday
  $weekend = ['Saturday', 'Sunday'];
  return (in_array($mydate, $weekend))? 'true':'false';
}

$year = date('Y');

$date = new DateTime();
$list =[];

for($i = 0; $i < 12; $i++)
{ //Loop through months for current year
  $monthNo = $i + 1;
  $date->setDate($year,$monthNo,01);
  $monthName = $date->format('F');

  $date->modify('last day of this month');
  // set date to last day of the current month
  if(is_weekend($date->format('l')) == 'true')
  {// check if last day of the month falls on weekend
    $date->modify('previous friday');
    //Modify date to the last friday
  }
  $pay_day = $date->format('l d/m/Y');
  //Date of salary payment

  // $monthNo = $monthNo + 1;
  if($monthNo == 12)
  {// check if current month is december
    $year = $year + 1;
    $monthNo = 1;
    // Set month to january & increment the year by 1
  }
  $date->setDate($year,$monthNo, 15);
  // set date to 15th of the following month for bonus
  if(is_weekend($date->format('l')) == 'true')
  {
    $date->modify('next wednesday');
    //Modify date to the next wednesday
  }

  $bonus_day = $date->format('l d/m/Y');
  // Date of bonus payment
  echo $monthName;
  echo " ";
  echo $pay_day;
  echo " ";
  echo $bonus_day;
  echo "\n";

  array_push($list,[$monthName, $pay_day, $bonus_day]);
}

$csv = new CsvGenerator($filename);
$csv->createContext($list);

?>
