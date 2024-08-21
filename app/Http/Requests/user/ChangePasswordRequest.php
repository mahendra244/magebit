<?php

namespace App\Http\Requests\user;

use App\Http\Requests\Request;

class ChangePasswordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
           'new_password'     => 'required',
           'new_confirm_password' => 'required|same:new_password',
          ];
    }

   public function messages()
   {
      return [
          'new_password.required' => 'Enter the new password',
          'new_confirm_password.required' => 'Enter the confirm password',
          'new_confirm_password.same'  => 'New password  and confirm password does not match',

      ];
   }
}
