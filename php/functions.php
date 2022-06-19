<?php
/**
 * Created by : PhpStorm.
 * User : keith
 * Date : 17/06/2022
 */
declare(strict_types=1);

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

/**
 * @param array $headings
 */

function printHeader(array $headings) :void{
	$headerRow ='';
	for($col = 0; $col < count($headings); $col++) {
		$headerRow .= paddingString($headings[$col]);
	}
	echo PHP_EOL.$headerRow.PHP_EOL;
}

/**
 * @param string $character
 * @param int $columnNo
 * @param int $colWidth
 */
function printBorder (string $character, int $columnNo=0, int $colWidth=20) :void{
	$border = '';
	for($col =0; $col < $columnNo; $col++) {
		$border .= paddingString($character,$colWidth ,$character);
	}
	echo $border.PHP_EOL;
}

/**
 * @param DateTime $date
 * @param int $year
 * @param int $monthNo
 */
function getSalaryDate(DateTime &$date, int $year, int $monthNo){
	// set date to last day of the current month
	$date->modify('last day of this month');

	// check if last day of the month falls on weekend
	if(isWeekend($date->format('l'))) {
		//Modify date to the last friday
		$date->modify('previous friday');
	}
}

/**
 * @param DateTime $date
 * @param int $year
 * @param int $monthNo
 */
function getBonusDate(DateTime &$date, int $year, int $monthNo){
	// check if current month is december
	if(isDecember($monthNo)) {
		// Set month to january & increment the year by 1
		$year++;
		$monthNo = 1;
	} else {
		$monthNo++;
	}

	// set date to 15th of the following month for bonus
	$date->setDate($year, $monthNo, 15);

	if(isWeekend($date->format('l'))) {
		//Modify date to the next wednesday
		$date->modify('next wednesday');
	}
}

/**
 * @param DateTime $date
 * @param string $dateYear
 * @param string $dateFormat
 * @param bool $debug
 * @return array
 */
function getSalaryAndBonusDates(DateTime $date, string $dateYear, string $dateFormat, bool $debug = false) :array {
	$list = [];
	$year = (int)$dateYear;

	//Loop through months for current year
	for($monthNo = 1; $monthNo <= MONTH_IN_A_YEAR; $monthNo++)
	{

		$date->setDate($year, $monthNo, 01);
		$monthName = $date->format('F');

		getSalaryDate($date,$year,$monthNo);
		$pay_date = $date->format($dateFormat);

		getBonusDate($date, $year,$monthNo);
		$bonus_date = $date->format($dateFormat);

		$dataRow = [$monthName, $pay_date, $bonus_date];

		if($debug == 'true') {
			foreach($dataRow as $cellData)
			{
				echo paddingString($cellData);
			}
			echo PHP_EOL;
		}

		array_push($list,$dataRow );
	}

	return $list;
}


