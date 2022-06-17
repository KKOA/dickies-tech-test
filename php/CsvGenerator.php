<?php
/**
 * Created by : PhpStorm.
 * @author keith
 * Date : 17/06/2022
 * @copyright 24/01/2018
 * @version 1.1
 */
declare(strict_types=1);


/**
 * Class CsvGenerator
 */
class CsvGenerator
{
	/**
	 * @var string
	 */
	private string $filename;
	/**
	 * @var false|resource
	 */
	private $fileHandle;
	/**
	 *
	 */
	const EXT = '.csv';


	/**
	 * CSVGen constructor.
	 * On instantiate an object, opens a file pointer and points at file in write mode.
	 * If file does not exist, it creates the file.
	 * Open file in write mode.
	 * User can specify a filename or it uses payroll[current year].csv
	 * @param null $filename
	 */
	public function __construct($filename = null) {
		print "\nOpen file connection\n";
		if($filename)
			$this->$filename = $filename;
		else
			$this->$filename = 'payroll'.date("Y");

		$this->$filename .= self::EXT;
		echo $this->$filename;

		$this->fileHandle = fopen($this->$filename,'w');
	}

	/**
	 * Generate array of all the headers
	 * @return array|string[]
	 */
	private function createHeader() :array
	{
		return ['Month','Salary date','Bonus date'];
	}

	/**
	 * Add data to the csv file
	 * @param array $data
	 */
	public function createContext(array $data):void {
		print "\nWriting to file\n";
		array_unshift($data, $this->createHeader());
		foreach ($data as $fields)
		{
			fputcsv($this->fileHandle, $fields);
		}
	}

	/**
	 * Closes an open file pointer after last call to the object
	 */
	public function __destruct() {
		print "\nClose file connection\n";
		fclose($this->fileHandle);
	}

}