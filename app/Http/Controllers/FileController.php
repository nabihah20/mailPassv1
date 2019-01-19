<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\File;
use App\User;
use Mail;
use Illuminate\Support\Facades\Storage;
use jdavidbakr\MailTracker\Model\SentMail;
use Redirect;
use Session;

ini_set('max_execution_time', 300); 

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', '2fa'] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $files = File::orderBy('created_at','DESC')->paginate(30);
        return view('file.index')->with('files', $user->files);
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
                'path' => $file->store('public/storage'),
                'user_id' => auth()->user()->id
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

    public function encryptfile()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $files = File::orderBy('created_at','DESC')->paginate(30);
        return view('file.encryptfile')->with('files', $user->files);
    } 
    
    public function createtofile()
    {
        return view('file.uploadtomail');
    }

    public function storetofile(Request $request)
    {
        //$this->validate($request, [
            //'file' => 'required|file|max:20000'
        //]);

        $files = $request->file('file');
        
        foreach ($files as $file) {
            File::create([
                'title' => $file->getClientOriginalName(),
                'description' => '',
                'path' => $file->store('public/storage'),
                'user_id' => auth()->user()->id
            ]);
        }

        return redirect('/encryptfile')->with('success','File Uploaded');
    }

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
        $data = array('title' =>$fl->title, 'path'=>$fl->path, 'id' =>$fl->id);
        Mail::send('mails.attachnoencrypt', $data, function($message) use($fl) {
            $message->to('bihatq@gmail.com', 'Biha')->subject('Laravel file');
            $message->attach(storage_path("app/".$fl->path));
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

    public function encrypt ($id)
    {
        //find file
        $fl = File::find($id);
        // Get File Content
        $fileContent = Storage::get($fl->path);
        // Encrypt the content
        $encryptedContent = encrypt($fileContent);
        // Store file
        Storage::put("app/".$fl->path, $encryptedContent);

        return Redirect::route( 'createMail' )
            ->with( 'title', $fl->title )
            ->with( 'encryptedContent', $encryptedContent )
            ->with( 'id', $fl->id )
            ->with( 'path', $fl->path );
        }

    public function createMail ()
    {
        return view('file.createMail');
    }   

    public function sentMail (Request $request)
    {
        // Get data from previous function using session
        $title = Session::get( 'title' );
        $encryptedContent = Session::get( 'encryptedContent' );
        $id = Session::get( 'id' );
        $path = Session::get( 'path' );

        // Required validation
        $this->validate($request, [
            'recipient'=>'required',
            'subject'=>'required',
            'content'=>'required'
        ]);

        //Request from user
        $recipient = $request->input('recipient');
        $subject = $request->input('subject');
        $content = $request->input('content');
        $title = $request->input( 'title' );
        $id = $request->input( 'id' );
        $path = $request->input( 'path' );
        
        //send data
        $data = array(
            'email' => auth()->user()->email,
            'recipient' => $recipient,
            'subject' => $subject,
            'content' => $content,
            'title' => $title,
            'encryptedContent' => $encryptedContent,
            'id' => $id,
            'path' => $path
            );
        
        //return view('mails.attachment') -> with($data);
        //Send email    
        Mail::send('mails.attachment', $data, function($message) use($data)  
        {
            $message->from($data['email']);
            $message->to($data['recipient']);
            $message->subject($data['subject']);
            //Attach file
            $message->attach(storage_path("app/app/".$data['path']));
        });

        return redirect('/dashboard')->with('success','Encrypted File Attachment Sent');
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
