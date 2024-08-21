<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserEmail extends Model
{
    protected $table ="user_email_id";
    protected $fillable = ['email_id','unique_code'];
    public function messageid()
    {
        return $this->hasMany('App\Model\UserEmailMessageID','email_user_id');
    }
   
   
}
