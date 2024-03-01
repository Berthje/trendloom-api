<?php
namespace App\Helpers;

class CsvHandler
{
    public function __construct()
    {
        //
    }

    public function getDataFromCsv($csv){
        $path = storage_path($csv);
        $file = fopen($path, 'r');

        $columns = fgetcsv($file, 0, ";");
        $data = [];
        while (($line = fgetcsv($file, 0, ";")) !== FALSE) {
            $data[] = [
                $columns[0] => $line[0],
                $columns[1] => $line[1],
            ];
        }

        fclose($file);
        return $data;
    }
}

