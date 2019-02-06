<?php
/**
 * Class to generate csv file.
 * 
 * @author Keith Amoah
 * @copyright 24/01/2018
*/

class CsvGenerator
{

    /**
   * @var string $filename
   */

  private $filename;

  private $fileHandle; //file pointer or FALSE

    /**
   * @const string EXT 
   */
  const EXT = '.csv';

  /**
   * On instantiate an object, opens a file pointer and points at file in write mode. If file does not exist, it creates the file.
   * Open file in write mode.  User can specify a filename or it uses payroll[current year].csv
   * @param string $filename
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
    * @return array 
    */
   private function createHeader()
   {
     return ['Month','Salary date','Bonus date'];
   }

   /**
    * Add data to the csv file
    * @param array $data
    */
   
   public function createContext($data) {
        print "\nWriting to file\n";
        array_unshift($data, $this->createHeader());
        foreach ($data as $fields)
        {
          fputcsv($this->fileHandle, $fields);
        }
    }

  /**
   * Closes an open file pointer after last call to the object
   * 
   */
   public function __destruct() {
    print "\nClose file connection\n";
    fclose($this->fileHandle);
   }
}
