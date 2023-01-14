<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeasonsCreateFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'numberOfSeasons' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'numberOfSeasons.required' => 'numberOfSeasons is required',
            'numberOfSeasons.numeric' => 'numberOfSeasons must be a number',
        ];
    }
}
