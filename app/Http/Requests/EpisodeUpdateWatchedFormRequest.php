<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeUpdateWatchedFormRequest extends FormRequest
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
            'watched' => ['required', 'boolean']
        ];
    }

    public function messages()
    {
        return [
            'watched.required' => 'watched is required',
            'watched.numeric' => 'watched must be a boolean'
        ];
    }
}
