<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePredictionRequest extends FormRequest
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
            'team_1_id' => 'required|exists:teams,id',
            'team_2_id' => 'required|exists:teams,id|different:team_1_id',
            'title' => 'required|string|max:255',
            'match_date' => 'required|date',
            'match_time' => 'required',
            'text' => 'nullable|string',
            'is_teaser' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
            'plan_deductions' => 'required|array',
            'plan_deductions.*' => 'integer|min:0',
            'league_id' => 'required|exists:leagues,id',
            'teaser_text' => 'nullable|string|max:255',
            'end_time' => 'nullable',
            'timezone' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'is_teaser' => $this->has('is_teaser'),
        ]);
    }
}
