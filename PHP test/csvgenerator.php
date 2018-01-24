<?php
/*
Description : Class to generate csv file.
Author : Keith Amoah
Date : 24/01/2018
*/

class CsvGenerator
{
  private $filename;
  private $filehandle;

  public function __construct($filename='') {
    print "\nOpen file connection\n";
    if($filename != '')
    {
     $this->$filename =$filename.'.csv';
     echo $this->$filename;
    }
    else {
     $this->$filename= $filename = 'instructions'.date("Y").'.csv';
    }
    // $this->filehandle = fopen($filename,'w');
    $this->filehandle = fopen($this->$filename,'w');
   }

   private function createHeader()
   {
     return ['Month','Salary date','Bonus date'];
   }

   public function createContext($data) {
        print "\nWriting to file\n";
        array_unshift($data, $this->createHeader());
        foreach ($data as $fields)
        {
          fputcsv($this->filehandle, $fields);
        }
    }

   public function __destruct() {
    print "\nClose file connection\n";
    fclose($this->filehandle);
   }
}
