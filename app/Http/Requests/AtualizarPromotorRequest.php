<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AtualizarPromotorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:100'],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('promotores', 'email')->ignore(
                    $this->route('promotor')
                ),
            ],
            'telefone' => ['nullable', 'string', 'max:30'],
            'ativo' => ['required', 'boolean'],
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
            'ativo.required' => 'Informe se o promotor está ativo.',
            'ativo.boolean' => 'A situação do promotor é inválida.',
        ];
    }
}
