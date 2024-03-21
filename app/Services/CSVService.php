<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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
            throw ValidationException::withMessages($validator->errors()->all());
        }
    }

    public static function processCSV($filePath)
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();
        foreach ($records as $index => $record) {
            $validator = Validator::make($record, [
                'Name' => 'required|string|max:255',
                'Email' => 'required|email|max:255',
                // 'Age' => 'required|integer|min:0|max:150',
                'Registration Date' => 'required|date_format:Y-m-d H:i:s',
            ]);

            if ($validator->fails()) {
                $errors = ["Validation error on line " . ($index + 1) . "."];

                foreach ($validator->errors()->all() as $errorMessage) {
                    $errors[] = $errorMessage;
                }

                if (count($errors) > 1) {
                    throw ValidationException::withMessages($errors);
                }
            }

            $processedData[] = [
                'name' => $record['Name'],
                'email' => $record['Email'],
                // 'age' => intval($record['Age']),
                'registration_date' => date('Y-m-d H:i:s', strtotime($record['Registration Date'])),
            ];
        }

        return $processedData;
    }
}
