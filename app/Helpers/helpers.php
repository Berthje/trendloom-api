<?php
// app/Helpers/CsvHelper.php
function getDataFromCsv($path)
{
    $file = fopen($path, 'r');
    $header = fgetcsv($file);
    $data = [];
    while ($row = fgetcsv($file)) {
        $data[] = array_combine($header, $row);
    }
    fclose($file);
    return $data;
}
