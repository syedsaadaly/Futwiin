<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateTeamRequest extends FormRequest
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
        $teamId = $this->route('id');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:teams,name,'.$teamId
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Team name is required',
            'name.unique' => 'This team name already exists',
            'name.max' => 'Team name cannot exceed 255 characters'
        ];
    }
}
