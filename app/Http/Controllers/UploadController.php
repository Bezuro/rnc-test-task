<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class UploadController extends Controller
{
    public function upload(Request $request): Response
    {
        $file = $request->file('file');
        dd($file);

        // return Inertia::render('Welcome');
    }

}
