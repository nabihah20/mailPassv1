<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    // Table Name
    protected $table = 'mails';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamp = true;

    public function user(){
        return $this ->belongsTo('App\User');
    }
}
