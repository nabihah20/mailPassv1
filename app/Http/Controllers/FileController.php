<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\File;
use Illuminate\Support\Facades\Storage;
use Mail;

ini_set('max_execution_time', 300); 

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::orderBy('created_at','DESC')->paginate(30);
        return view('file.index', ['files'=>$files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('file.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->validate($request, [
            //'file' => 'required|file|max:20000'
        //]);

        $files = $request->file('file');
        foreach ($files as $file) {
            File::create([
                'title' => $file->getClientOriginalName(),
                'description' => '',
                'path' => $file->store('public/storage')
            ]);
        }

        return redirect('/file')->with('success','File Uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dl = File::find($id);
        return response()->file($pathToFile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fl = File::find($id);
        $data = array('title' =>$fl->title, 'path'=>$fl->path);
        Mail::send('mails.attachment', $data, function($message) use($fl) {
            $message->to('bihatq@gmail.com', 'Biha')->subject('Laravel file');
            $message->attach(storage_path("app/app".$fl->path));
            $message->from('nabihah.student@gmail.com', 'Nabihah');
        });
        return redirect('/file')->with('success','File Attachment has been sent to your email');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function download($id)
    {
        $dl = File::find($id);
        return Storage::download($dl->path, $dl->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = File::find($id);
        Storage::delete($del->path);
        $del->delete();
        return redirect('/file')->with('success','File Deleted');
    }

    public function encrypt($id)
    {
        $fl = File::find($id);
        // Get File Content
        $fileContent = Storage::get($fl->path);
        // Encrypt the content
        $encryptedContent = encrypt($fileContent);
        // Store file
        Storage::put("app/".$fl->path, $encryptedContent);

        $data = array('title' =>$fl->title, $encryptedContent, $fl->$id);
        Mail::send('mails.attachment', $data, function($message) use($fl) {
            $message->to('bihatq@gmail.com', 'Biha')->subject('Laravel file');
            $message->attach(storage_path("app/app/".$fl->path));
            $message->from('nabihah.student@gmail.com', 'Nabihah');
        });
        return redirect('/file')->with('success','File Attachment has been sent to your email');
        
        //return redirect('/file')->with('success','File Encrypted');
    }

    public function decrypt($id)
    {
        $fl = File::find($id);
        // Get File Content
        $fileContent = Storage::get($fl->path);
        // Encrypt the content
        $encryptedContent = encrypt($fileContent);
        $decryptedContent = decrypt($encryptedContent);
        return response()->streamDownload(function() use ($decryptedContent) {
            echo $decryptedContent;
        }, 'decrypt file.doc');
    }
}
