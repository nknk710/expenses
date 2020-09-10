<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class History extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'date' => 'required',
        'category' => 'required',
        'content' => 'required',
        'cost' => 'required|integer',
    );
    
    // usersテーブルと関連付け
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
