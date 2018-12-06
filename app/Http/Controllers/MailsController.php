<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mails;
use Mail;

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
    public function store(Request $request)
    {
        $this->validate($request,[
            'recipientEmail'=>'required',
            'subject'=>'required',
            'message'=>'required'
        ]);
        
        //create Mail
        $mail = new Mails;
        $mail->email = auth()->user()->email;
        $mail->recipientEmail = $request ->input('recipientEmail');
        $mail->subject = $request ->input('subject');
        $mail->message = $request->input('message');
        $mail->user_id = auth()->user()->id;
        $mail->save();

        //$data = [
            //'email' => auth()->user()->email,
            //'recipientEmail' => $request ->recipientEmail,
            //'subject' => $request ->subject,
            //'message' => $request->message, 
        //];

        //Send Mail
        //Mail::send('mails.create',$data,function($message) use ($data){
            //$message -> from ($data['email']);
            //$message -> to ($data['recipientEmail']);
            //$message -> subject ($data['subject']);
        //});

        return redirect('/mails')->with('success', 'Mails Sent');
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
