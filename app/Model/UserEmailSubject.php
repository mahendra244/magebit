<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserEmailSubject extends Model
{
    protected $table = "user_subject";
    protected $fillable = ['euser_id','email_subject'];
    public function messageid() {
        return $this->belongsTo('App\Model\UserEmailMessageID','id');   
    }



}
