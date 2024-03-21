<?php

namespace App\Http\Controllers;

use App\Models\CSVData;
use App\Services\CSVService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __construct(
        protected CSVService $csvService,
    ) {}

    public function upload(Request $request)
    {
        $csvFile = $request->file('file');
        // dd($csvFile);

        // CSVService::validateCSV($csvFile);
        $this->csvService::validateCSV($csvFile);

        // $records = CSVService::readCSV($csvFile->path());
        $processedData = $this->csvService::processCSV($csvFile->path());

        // $processedData = CSVService::processCSV($records);
        // $processedData = $this->csvService::processCSV($records);

        try {
            foreach ($processedData as $item) {
                // dd($item);
                CSVData::create($item);
            }
            // return redirect()->back()->with('success', 'Data from CSV file has been successfully saved.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            // return redirect()->back()->with('error', 'An error occurred while saving data to the database: ' . $e->getMessage());
        }

        dd('created');
        // return Inertia::render('Welcome');
    }

}
