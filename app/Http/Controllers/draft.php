public function postMail(Request $request)
    {
        $data = [
        'email' => auth()->user()->email,
        'recipientEmail' => $request->input('recipientEmail'),
        'subject' => $request->input('subject'),
        'bodyMessage' => $request->input('bodyMessage'),
        ];

        $attach = $request->file('file');

        // Required validation
        $this->validate($request, [
            'recipientEmail'=>'required',
            'subject'=>'required',
            'bodyMessage'=>'required',
        ]);

        //https://accounts.google.com/DisplayUnlockCaptcha
        Mail::send('mails.viewMail', $data ,function ($message) use ($attach) 
        {
            $message->from($data['email']);
            $message->to($data['recipientEmail']);
            $message->subject($data['subject']);
            //Attach file
            $message->attach($attach);
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