<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmployeeData extends Model
{
    protected $table ="employee";
    protected $fillable = ['org_id', 'pe_id','is_updated'];
    public function scopeOrdered($query)
    {
        return $query->orderBy('company', 'asc')->get();
    }
}
