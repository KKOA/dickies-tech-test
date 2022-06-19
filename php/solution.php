<?php
declare(strict_types=1);

/**
 * Write payroll date for the current year to file.
 * Created by : PhpStorm.
 * @author keith
 * Date : 19/06/2022
 * @copyright 24/01/2018
 * @version 1.2
 */

require_once('CsvGenerator.php');
require_once('functions.php');

/*
Passing argument to file
Argument 1 - filename to save
Argument 2 - Turn On/Off debug mode. Take string true or false. When turned on outputs file contents to console.
*/

$filename = null;
$date = new DateTime();
$list = [];
$debug = false;
$dateFormat = "l d/m/Y";
$headers = ["Month","Salary date","Bonus date"];

/*
  Allows user to specify the file they wish to read from by passing it as the second argument in command prompt.
 When not stated, use default filename.
*/
if(isset($argv[1]))
{
	$filename = $argv[1];
}

if(isset($argv[2])){
	$debug = (bool)$argv[2];
}

if($debug == 'true')
{
	printHeader($headers);
	printBorder('-',count($headers));
}

$list = getSalaryAndBonusDates($date,date('Y'),$dateFormat,$debug );

if($debug == 'true'){
	printBorder('-',count($headers));
}

$csv = new CsvGenerator($filename);
$csv->createContext($list);