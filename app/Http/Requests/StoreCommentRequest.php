<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "post_id" => "required|integer|exists:posts,id",
            "content" => "required|string|min:1|max:255"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()
            ],
            400
        ));
    }

    public function messages(): array
    {
        return [
            "post_id.exists" => "O post não existe",
            "required" => "O campo :attribute é obrigatório.",
            "integer" => "O campo :attribute deve possuir apenas números inteiros",
            "max" => "O campo :attribute deve ter no máximo 255 caracteres",
            "min" => "O campo :attribute deve ter no mínimo 1 caracter",
        ];
    }
}
