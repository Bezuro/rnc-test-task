<?php

namespace App\Http\Controllers;

use App\Models\CSVData;
use App\Services\CSVService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class UploadController extends Controller
{
    public function __construct(
        protected CSVService $csvService,
    ) {}

    public function upload(Request $request)
    {
        $errors = [];
        $csvFile = $request->file('file');

        try {
            $this->csvService::validateCSV($csvFile);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return Inertia::render('CSVForm', ['errors' => $errors]);
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
            return Inertia::render('CSVForm', ['errors' => $errors]);
            // return Inertia::render('CSVForm', ['error' => $e->getMessage()]);
        }

        try {
            $processedData = $this->csvService::processCSV($csvFile->path());
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            dd($errors);
            return Inertia::render('CSVForm', ['errors' => $errors]);
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
            return Inertia::render('CSVForm', ['errors' => $errors]);
        }

        try {
            foreach ($processedData as $item) {
                CSVData::create($item);
            }
        } catch (Exception $e) {
            $errors[] = 'An error occurred while saving data to the database: ' . $e->getMessage();
            return Inertia::render('CSVForm', ['errors' => $errors]);
            // return Inertia::render('CSVForm', ['error' => 'An error occurred while saving data to the database: ' . $e->getMessage()]);
        }

        return Inertia::render('CSVForm', ['success' => 'Data from CSV file has been successfully saved!']);
    }

}
