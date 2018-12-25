<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    public function index(){
        //return 'INDEX';
        return view ('pages.index');
    }

    public function about(){
        return view ('pages.about');
    }
    public function main()
    {
        try {
            $encryptedContent = Storage::get('file.dat');
            $decryptedContent = decrypt($encryptedContent);
        } catch (Exception $e) {
            $encryptedContent = null;
            $decryptedContent = null;
        }
        return view('encrypt', compact('encryptedContent', 'decryptedContent'));
    }

    public function upload (Request $request)
    {
        $this->validate($request, [
        'attachment' => ['required', 'file']
        ]);

        $file = $request->file('attachment');
        // Get File Content
        $fileContent = $file->get();
        // Encrypt the content
        $encryptedContent = encrypt($fileContent);
        // Store file
        Storage::put('file.dat', $encryptedContent);
        return view('encrypt');
    }

    public function download(){
        $encryptedContent = Storage::get('file.dat');
        $decryptedContent = decrypt($encryptedContent);
        return response()->streamDownload(function() use ($decryptedContent) {
            echo $decryptedContent;
        }, 'file.jpg');

    }
}
