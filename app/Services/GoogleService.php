<?php

namespace App\Services;

use Google\Client;
// use Google\Service\Drive;
use Google\Service\Sheets;
use Google\Service\Drive\DriveFile;
// use Google\Http\MediaFileUpload;

use Google\Service\Drive;
use Google\Service\Drive\MediaFileUpload;

class GoogleService
{
    protected $driveService;
    protected $sheetsService;

    public function __construct()
    {
        $client = new Client();
        $client->setApplicationName('Heroic');
        // $client->setAuthConfig(env('GOOGLE_APPLICATION_CREDENTIALS'));
        //$client->setAuthConfig(base_path(env('GOOGLE_APPLICATION_CREDENTIALS')));
        $client->addScope(Drive::DRIVE_FILE);
        $client->addScope(Sheets::SPREADSHEETS);

        $this->driveService = new Drive($client);
        $this->sheetsService = new Sheets($client);
    }  


    public function makeFilePublic($fileId)
        {
            $permission = new \Google\Service\Drive\Permission();
            $permission->setRole('reader');
            $permission->setType('anyone');
            $this->driveService->permissions->create($fileId, $permission);
        }


    public function uploadImage($filePath)
    { 
        $fileMetadata = new DriveFile([
            'name' => basename($filePath),
        ]);

        $mimeType = mime_content_type($filePath);

      $file = $this->driveService->files->create($fileMetadata, [
         'data' => file_get_contents($filePath),
         'mimeType' => $mimeType,
         'uploadType' => 'multipart',
         'fields' => 'id'
     ]);
     
     $fileId = $file->id;
     echo "File ID: " . $fileId;

        return $file->id;
    }

    // public function insertImageLink($cellRange, $fileId)
    // {
    //     $imageUrl = "https://drive.google.com/uc?id=$fileId";

    //     $values = [
    //         [$imageUrl], // Insert the image URL into the specified cell
    //     ];

    //     $body = new \Google\Service\Sheets\ValueRange([
    //         'values' => $values,
    //     ]);

    //     $this->sheetsService->spreadsheets_values->update(
    //         env('SPREADSHEET_ID'),
    //         $cellRange,
    //         $body,
    //         ['valueInputOption' => 'RAW']
    //     );
    // } 

    public function insertImageLink($sheetId, $imageLink)
    {
        $nextRow = $this->getNextAvailableRow($sheetId); // Get the next empty row
        $range = "Sheet1!A$nextRow"; // Define the cell for insertion

        $body = new \Google\Service\Sheets\ValueRange([
            'values' => [[$imageLink]]
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];

        $this->sheetsService->spreadsheets_values->update($sheetId, $range, $body, $params);
    }


    public function getNextAvailableRow($sheetId, $range = 'Sheet1!A:A')
        {
            $response = $this->sheetsService->spreadsheets_values->get($sheetId, $range);
            $values = $response->getValues();

            return count($values) + 1; // Next empty row
        }

}
