<?php
declare(strict_types=1);
/**
* Write payroll date for the current year to file.
*
* @author : Keith Amoah
* @copyright : 24/01/2018
*/

require_once('CsvGenerator.php');


/* Passing argument to file
Argument 1 - filename to save
Argument 2 - Turn On/Off debug mode. Take string true or false. When turned on outputs file contents to console.
*/

define('WEEKEND',['Saturday', 'Sunday']);
define('MONTH_IN_A_YEAR', 12);

/**
 * Return true if date falls on saturday or sunday
 *
 * @param string $myDate
 * @param string[] $weekend
 * @return bool
 */
function isWeekend(string $myDate, $weekend = WEEKEND) :bool
{
	return (in_array($myDate, $weekend));
}

/**
 * Return true if month is december
 *
 * @param int $monthNo
 * @param int $monthInAYear
 * @return boolean
 */

function isDecember(int $monthNo, $monthInAYear = MONTH_IN_A_YEAR) :bool
{
	return $monthNo === $monthInAYear;
}

/**
 * Return padded string
 *
 * @param string $str
 * @param int $length
 * @param string $char
 * @return string
 */

function paddingString(string $str, $length = 20, $char = " " )
{
	return str_pad($str, $length, $char, STR_PAD_BOTH)." | ";
}

$filename = null;

/* 
  Allows user to specify the file they wish to read from by passing it as the second argument in command prompt.
 When not stated, use default filename. 
*/
if(isset($argv[1]))
{
	$filename = $argv[1];
}

$year = (int)date('Y');

$date = new DateTime();

$list = [];


if((isset($argv[2])) && ($argv[2] == 'true'))
{
	echo PHP_EOL.paddingString("Month").paddingString("Salary date").paddingString("Bonus date").PHP_EOL;
  echo paddingString("-",20 ,"-").paddingString("-",20 ,"-").paddingString("-",20 ,"-").PHP_EOL;
}


//Loop through months for current year
for($i = 1; $i <= MONTH_IN_A_YEAR; $i++)
{
	$monthNo = $i;
	$date->setDate($year, $monthNo, 01);
	$monthName = $date->format('F');

	// set date to last day of the current month
	$date->modify('last day of this month');

	// check if last day of the month falls on weekend
	if(isWeekend($date->format('l')))
	{
		//Modify date to the last friday
		$date->modify('previous friday');
	}

	//Date of salary payment
	$pay_day = $date->format('l d/m/Y');

	// check if current month is december
	if(isDecember($monthNo))
	{
	// Set month to january & increment the year by 1
		$year++;
		$monthNo = 1;
	}
	else
	{
		$monthNo++;
	}

	// set date to 15th of the following month for bonus
	$date->setDate($year, $monthNo, 15);

	if(isWeekend($date->format('l')))
	{
		//Modify date to the next wednesday
		$date->modify('next wednesday');
	}

	// Date of bonus payment
	$bonus_day = $date->format('l d/m/Y');


	if(isset($argv[2]) && $argv[2] == 'true'){
		echo paddingString($monthName);
		echo paddingString($pay_day);
		echo paddingString($bonus_day).PHP_EOL;
	}

	// str_pad($str,10,".",STR_PAD_LEFT);
	array_push($list,[$monthName, $pay_day, $bonus_day]);
}

if(isset($argv[2]) && $argv[2] == 'true'){
  echo paddingString("-",20 ,"-").paddingString("-",20 ,"-").paddingString("-",20 ,"-").PHP_EOL;
}

$csv = new CsvGenerator($filename);

$csv->createContext($list);


