<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BotCreateFormRequest extends FormRequest
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
            'local_name' => 'required|regex:/^@[a-z_]+_bot$/i',
            'api_key' => 'required|string'
        ];
    }
}
