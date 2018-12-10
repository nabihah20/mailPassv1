<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mails;
use Mail;
use Swift_Transport;
use Swift_Message;
use Swift_Mailer;
use App\Http\Controllers\Controller;

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
    
    //public function store(Request $request)
    //{
        //$this->validate($request,[
            //'recipientEmail'=>'required',
            //'subject'=>'required',
            //'message'=>'required'
        //]);
        
        //create Mail
        //$mails = new Mails;
        //$mails->email = auth()->user()->email;
        //$mails->recipientEmail = $request ->input('recipientEmail');
        //$mails->subject = $request ->input('subject');
        //$mails->message = $request->input('message');
        //$mails->user_id = auth()->user()->id;
        //$mails->save();
    //}

    public function postMail(Request $request)
    {
        $this->validate($request,[
            'recipientEmail'=>'required',
            'subject'=>'required',
            'bodyMessage'=>'required'
        ]);

        $data_toview = array();
        $data_toview['bodyMessage']= $request->input('bodyMessage');

        $email_sender 	= auth()->user()->email;
        $email_pass		= 'terbilang';
        $email_to 		= $request ->input('recipientEmail');

        // Backup your default mailer
        $backup = \Mail::getSwiftMailer();

        try{

                    //https://accounts.google.com/DisplayUnlockCaptcha
                    // Setup your gmail mailer
                    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                    $transport->setUsername($email_sender);
                    $transport->setPassword($email_pass);

                    // Any other mailer configuration stuff needed...
                    $gmail = new Swift_Mailer($transport);

                    // Set the mailer as gmail
                    Mail::setSwiftMailer($gmail);

                    $data['emailto'] = $email_sender;
                    $data['sender'] = $email_to;
                    //Sender dan Reply harus sama

                    Mail::send('mails.create', $data_toview, function($message) use ($data)
                    {

                        $message->from($data['sender'], 'Laravel Mailer');
                        $message->to($data['emailto'])
                        ->replyTo($data['sender'], 'Laravel Mailer')
                        ->subject($request ->input('subject'));

                        return redirect('/mails')->with('success', 'Mails Sent');

                    });

        }catch(\Swift_TransportException $e){
            $response = $e->getMessage() ;
            echo $response;
        }


        // Restore your original mailer
        Mail::setSwiftMailer($backup);

                //Store Mail
                $mails = new Mails;
                $mails->email = auth()->user()->email;
                $mails->recipientEmail = $request ->input('recipientEmail');
                $mails->subject = $request ->input('subject');
                $mails->message = $request->input('bodyMessage');
                $mails->user_id = auth()->user()->id;
                $mails->save();
        //$info = [
            //'email' => auth()->user()->email,
            //'recipientEmail' => $request ->input('recipientEmail'),
            //'subject' => $request ->input('subject'),
            //'message' => $request->input('message'),
        //];

        //Send Mail
        //Mail::send('mails.create',["data1"=>$data] , function($message){
            //$message -> from ('bihatq@gmail.com','terbilang');
            //$message -> to ($data1['recipientEmail']);
            //$message -> subject ($data1['subject']);
        //});

        //return redirect('/mails')->with('success', 'Mails Sent');
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
