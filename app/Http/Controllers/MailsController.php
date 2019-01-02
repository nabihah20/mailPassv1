<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use jdavidbakr\MailTracker\Model\SentEmail;
use SentMail;
use Mail;
use Auth;
use Illuminate\Support\Facades\Crypt;

ini_set('max_execution_time', 300); 

class MailsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        //$mails = Mails::all();
        $sent_emails = Mails::orderBy('created_at','desc')->paginate(10);
        return view('mails.index')->with('sent_emails',$sent_emails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function postMail(Request $request)
    {
        $data = array(
        'email' => auth()->user()->email,
        'recipient' => $request->input('recipient'),
        'subject' => $request->input('subject'),
        'content' => $request->input('content'),
        );

        // Required validation
        $this->validate($request, [
            'recipient'=>'required',
            'subject'=>'required',
            'content'=>'required'
        ]);

        //https://accounts.google.com/DisplayUnlockCaptcha
        Mail::send('mails.viewMail', $data ,function ($message) use ($data) 
        {
            $message->from($data['email']);
            $message->to($data['recipient']);
            $message->subject($data['subject']);
            //Attach file
            $message->attach($data['uploaded_file']->getRealPath(),
            //if (isset($_FILES['uploaded_file']) &&
                //$_FILES['uploaded_file']['error'] == UPLOAD_ERR_OK) {
                //$mesagge->attach($_FILES['uploaded_file']['tmp_name'],
                         //$_FILES['uploaded_file']['name']);
            //}
            [
                'as' => $data['uploaded_file']->getClientOriginalName(),
                'mime' =>$data['uploaded_file']->getClientMimeType(),
            ]);
        });

        //Store Mail
        //$mails = new Mails;
        //$mails->email = auth()->user()->email;
        //$mails->recipientEmail = $request ->input('recipientEmail');
        //$mails->subject = $request ->input('subject');
        //$mails->bodyMessage = $request->input('bodyMessage');
        //$sent_emails->user_id = auth()->user()->id;
        //$mails->save();

        return redirect('composemail')->with('success', 'Mails Sent');
    }

    public function createnoattach()
    {
        return view('mails.createnoattach');
    }

    public function postMailNoAttach(Request $request)
    {
        // Required validation
        $this->validate($request, [
            'recipient'=>'required',
            'subject'=>'required',
            'content'=>'required'
        ]);

        $data = array(
            'sender' => auth()->user()->email,
            'recipient' => $request->input('recipient'),
            'subject' => $request->input('subject'),
            'content' => $request->input('content'),
        );

        //https://accounts.google.com/DisplayUnlockCaptcha
        Mail::send('vendor.emailTrakingViews.emails.mensaje_layout', $data ,function ($message) use ($data) 
        {
            $message->from($data['sender']);
            $message->to($data['recipient']);
            $message->subject($data['subject']);
        });

        //Store Mail
        //$mails = new Mails;
        //$mails->email = auth()->user()->email;
        //$mails->recipientEmail = $request ->input('recipientEmail');
        //$mails->subject = $request ->input('subject');
        //$mails->bodyMessage = $request->input('bodyMessage');
        //$sent_emails->user_id = auth()->user()->id;
        //$mails->save();

        return redirect('composemessage')->with('success', 'Mails Sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sent_email = SentEmail::find($id);
        return view('mails.show')->with('sent_email',$sent_email);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sent_emails = SentEmail::find($id);
        $sent_emails -> delete();
        return redirect('dashboard')->with('succcess','Mail Removed');
    }
}
