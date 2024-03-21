<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;

class CSVService
{
    public static function validateCSV(UploadedFile $file)
    {
        $validator = Validator::make(
            ['csv_file' => $file],
            ['csv_file' => 'required|file|extensions:csv|mimes:csv']
        );

        if ($validator->fails()) {
            abort(422, $validator->errors()->first());
        }
    }

    public static function processCSV($filePath)
    {

        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); // Первая строка содержит заголовки

        $records = $csv->getRecords();
        foreach ($records as $record) {
            $validator = Validator::make($record, [
                'Name' => 'required|string|max:255',
                'Email' => 'required|email|max:255',
                'Age' => 'required|integer|min:0|max:150',
                'Registration Date' => 'required|date_format:Y-m-d H:i:s',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $processedData[] = [
                'name' => $record['Name'],
                'email' => $record['Email'],
                'age' => intval($record['Age']),
                'registration_date' => date('Y-m-d H:i:s', strtotime($record['Registration Date'])), // Преобразование формата даты
            ];
        }

        return $processedData;
        // foreach ($results as $row) {
        //     dd($row);
        // }

        // return $csv->getRecords();
    }
}
