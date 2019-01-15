<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use jdavidbakr\MailTracker\Model\SentEmail;

class Mails extends Model
{
    // Table Name
    protected $table = 'sent_emails';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamp = true;

    public function user(){
        return $this ->belongsTo('App\User');
    }
}
