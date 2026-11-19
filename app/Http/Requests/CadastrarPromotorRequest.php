<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastrarPromotorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:255', 'unique:promotores,email'],
            'telefone' => ['nullable', 'string', 'max:30'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Informe o nome do promotor.',
            'nome.string' => 'O nome do promotor deve ser um texto.',
            'nome.max' => 'O nome não pode ter mais de :max caracteres.',
            'email.email' => 'Informe um endereço de e-mail válido.',
            'email.max' => 'O e-mail não pode ter mais de :max caracteres.',
            'email.unique' => 'Já existe um promotor cadastrado com esse e-mail.',
            'telefone.string' => 'O telefone deve ser informado como texto.',
            'telefone.max' => 'O telefone não pode ter mais de :max caracteres.',
        ];
    }
}
