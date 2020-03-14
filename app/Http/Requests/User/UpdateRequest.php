<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'max:32', 'min:6', 
                    Rule::unique('users')->ignore($this->route('user'))],
            'name' => ['required', 'string', 'max:50', 
                    Rule::unique('users')->ignore($this->route('user'))],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'string']
        ];
    }
}
