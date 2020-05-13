<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{

    public function download($id)
    {

        // define permission flag
        $permission = false;

        // find document
        $document =  Document::find($id);


        if ($document === null)
            return 'Resource not found';

        // Verifi permissions
        if (auth()->user()->type == 'admin' || auth()->user()->id ===  $document->registration->student->user->id)
            $permission = true;


        if (!$permission)
            return 'No permissions to see the resource';

        $fileContent = Storage::disk('local')->get($document['file_path']);
        $mimetype =  Storage::disk('local')->mimeType($document['file_path']);
        $size = Storage::disk('local')->size($document['file_path']);


        $extension = File::extension($document['file_path']);;

        $filename = $document['file_type'] . '.' . $extension;

        $response = response($fileContent, 200, [
            'Content-Description' => 'File Transfer',
            'Content-Type' => $mimetype,
            'Content-Length' => $size,
            'Expires' => 0,
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => "inline; filename={$filename}",
            'Pragma' => 'public',
            'Content-Transfer-Encoding' => 'binary',
        ]);

        return $response;
    }
}
