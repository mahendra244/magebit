<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SearchSuggestion extends Model
{
    protected $table ="search_suggestion";
    protected $fillable = ['company_id','suggest_text'];
}
