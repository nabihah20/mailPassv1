<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mails;
use Mail;
//use Swift_Transport;
//use Swift_Message;
//use Swift_Mailer;
//use App\Http\Controllers\Controller;

class MailsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        //$mails = Mail::all();
        $mails = Mails::orderBy('created_at','desc')->paginate(10);
        return view('mails.index')->with('mails',$mails);
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
        $this->validate($request, [
            'recipientEmail'=>'required',
            'subject'=>'required',
            'bodyMessage'=>'required'
        ]);

        $data = array(
        'email' => auth()->user()->email,
        'recipientEmail' => $request->input('recipientEmail'),
        'subject' => $request->input('subject'),
        'bodyMessage' => $request->input('bodyMessage'),
        'file' => $request->input('file'),
        );

        $pathToFile = array(
            'file' => $request->input('file'),
        );


        //https://accounts.google.com/DisplayUnlockCaptcha

        Mail::send('mails.viewMail', $data,$pathToFile, function($message) use ($data) {
            $message->from($data['email']);
            $message->to($data['recipientEmail']);
            $message->subject($data['subject']);
            $message->attach($pathToFile, ['as' => $display, 'mime' => $mime]);
        });
                
        //Store Mail
        $mails = new Mails;
        $mails->email = auth()->user()->email;
        $mails->recipientEmail = $request ->input('recipientEmail');
        $mails->subject = $request ->input('subject');
        $mails->bodyMessage = $request->input('bodyMessage');
        $mails->user_id = auth()->user()->id;
        $mails->save();

        return redirect('dashboard')->with('success', 'Mails Sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mail = Mails::find($id);
        return view('mails.show')->with('mail',$mail);
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
        //
    }
}
