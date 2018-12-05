<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function index(){

        return view ('email.mail');
    }

    //public function about(){
        //return view ('email.sendEmail');
    //}

}
