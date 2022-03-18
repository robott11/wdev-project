<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonyRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Campo de nome vazio',
            'message.required' => 'Campo de mensagem vazio',
            'name.max' => 'O nome não pode ser maior de 255 caracteres',
            'message.max' => 'A mensagem não pode ser maior de 255 caracteres'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'message' => 'required|max:255'
        ];
    }
}
