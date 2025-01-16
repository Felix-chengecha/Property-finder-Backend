<?php

namespace App\Http\Controllers;
use App\Services\GoogleService;

use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    //

 protected $googleService;

    public function __construct(GoogleService $googleService)
    {
        $this->googleService = $googleService;
    }

 

public function uploadAndInsert(Request $request)
{
    $request->validate([
        'image' => 'required|image|max:2048',
    ]);

    $imagePath = $request->file('image')->store('images');
    $fullImagePath = storage_path("app/$imagePath");
    $sheetId = env('SPREADSHEET_ID'); 

    $fileId = $this->googleService->uploadImage($fullImagePath);
    $this->googleService->makeFilePublic($fileId);

    $imageUrl = "https://drive.google.com/uc?id=$fileId";

    // Insert the image URL into the next available row in Google Sheets
    $this->googleService->insertImageLink( $sheetId, $imageUrl);

    return view('image_display', ['imageUrl' => $imageUrl]);
}



}
