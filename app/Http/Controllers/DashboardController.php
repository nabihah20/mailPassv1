<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mails;
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
        $this->middleware('auth');
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
        return view('dashboard')->with('mails', $user ->mails)->with('status', 'You are logged in!');
    }

    public function inbox()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('inbox')->with('mails', $user ->mails)->with('status', 'You are logged in!');
    }

    public function settings()
    {
        $this->validate($request, [
            'recipientEmail'=>'required',
            'recipientPhone'=>'required',
            'type'=>'required'
        ]);

        //Store Settings
        //$mails = new Mails;
        //$mails->recipientEmail = $request ->input('recipientEmail');
        //$mails->recipientPhone = $request ->input('recipientPhone');
        //$mails->type = $request->input('type');
        //$mails->user_id = auth()->user()->id;
        //$mails->save();

        return redirect('dashboard')->with('success', 'Settings Saved');
    }
}
