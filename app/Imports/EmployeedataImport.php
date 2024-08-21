<?php

namespace App\Imports;

use App\EmployeeData;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeedataImport implements ToModel, WithHeadingRow
{
    public function authorize()
    {
        return true;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return $row;
    }
}
