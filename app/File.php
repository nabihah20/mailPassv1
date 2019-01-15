<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class File extends Model
{
    protected $fillable = [
        'title', 'description', 'path', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
