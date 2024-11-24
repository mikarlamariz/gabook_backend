<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBookRequest extends FormRequest
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
            "title" => 'required|string|max:455',
            "sinopse" => 'required|string',
            "cover" => 'image|size:2048',
            "release_year" => 'required|integer',
            "isbn" => 'required|string|max:17',
            "genre_id" => 'required|integer|exists:genres,id',
            "author_id" => 'required|integer|exists:authors,id'
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
            "string" => "O campo :attribute deve possuir texto",
            "title.max" => "O campo titulo deve possuir no máximo 455 caracteres",
            "cover.image" => "É necessário enviar uma imagem válida",
            "cover.max" => "O tamanho máximo do arquivo de imagem é 2MB.",
            "integer" => "O campo :attribute deve possuir número inteiro.",
            "genre_id.exists" => "Esse gênero não existe.",
            "author_id.exists" => "Esse autor não existe."
        ];
    }
}
