<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EvaluateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "book_id" => "required|integer|exists:books,id",
            "evaluation" => "required|integer|min:1|max:5"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()
            ]
        ));
    }

    public function messages(): array
    {
        return [
            "required" => "O campo :attribute é obrigatório.",
            "integer" => "O campo :attribute deve possuir apenas números inteiros",
            "max" => "O campo :attribute deve ir no máximo até a nota 5",
            "min" => "O campo :attribute deve ter no mínimo a nota 1",
        ];
    }
}
