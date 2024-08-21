<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserEmailTemplate extends Model
{
    protected $table ="user_template";
    protected $fillable = ['user_id','template_id'];

    public function messageid() {
        return $this->belongsTo('App\Model\UserEmailMessageID','id');   
    }
}
