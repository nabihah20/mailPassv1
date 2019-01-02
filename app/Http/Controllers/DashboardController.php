<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use jdavidbakr\MailTracker\Model\SentEmail;
use App\User;


class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('dashboard')->with('sent_emails', $user ->sent_emails)->with('status', 'You are logged in!');
    }

    public function inbox()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('inbox')->with('sent_emails', $user ->sent_emails)->with('status', 'You are logged in!');
    }

    public function setup()
    {
        return view('settings');
    }

    public function settings(Request $request)
    {
        $this->validate($request, [
            'phoneNo'=>'required',
        ]);

        //Store to Users
        $users = new User;
        $users->email =auth()->user()->email;
        $users->phoneNo = $request->input('phoneNo');
        $users->type2FA = $request->input('type2FA');

        //Send to Verification
        //$verification = $twizo->createVerification('phoneNo');
        //$verification->send();

        return redirect('dashboard')->with('success', 'Settings Saved');
    }
}
