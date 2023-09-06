<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class StorageFileController extends Controller
{
    //
    public function show($file)
{
    // Use Laravel's Storage facade to retrieve the file
    $path = storage_path("app/{$file}");

    // Check if the file exists
    if (!Storage::disk('local')->exists($file)) {
        abort(404); // Return a 404 Not Found response if the file doesn't exist
    }

    // Determine the file's MIME type
    $mime = Storage::disk('local')->mimeType($file);

    // Return the file with appropriate headers
    return response()->file($path, ['Content-Type' => $mime]);
}
}
