<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserEmailMessageID extends Model
{
    protected $table ="user_message_id";
    protected $fillable = ['message_id','email_user_id','message_status','process_date','click_status'];
    public function userEmail()
    {
        return $this->belongsTo('App\Model\UserEmail','id');
    }
    public function emailSubject() {
        return $this->hasMany('App\Model\UserEmailSubject', 'euser_id');   
    }

    public function emailTemplate() {
        return $this->hasMany('App\Model\UserEmailTemplate', 'user_id');   
    }
   
}
