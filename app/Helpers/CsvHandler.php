<?php
namespace App\Helpers;

class CsvHandler
{
    public function getDataFromCsv($csv){
        $path = storage_path($csv);
        $file = fopen($path, 'r');

        $columns = fgetcsv($file, 0, ";");
        $data = [];
        while (($line = fgetcsv($file, 0, ";")) !== false) {
            $rowData = [];
            foreach ($columns as $index => $column) {
                $rowData[$column] = $line[$index];
            }
            $data[] = $rowData;
        }

        fclose($file);
        return $data;
    }
}
