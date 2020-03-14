<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['required', 'string', Rule::unique('tasks')->ignore($this->route('task'))],
            'description' => ['required', 'string'],
            'assignee_id' => ['exists:users,id'],
            'start' => ['date', 'after:tomorrow'],
            'end' => ['date', 'after:start'],
        ];
    }
}
