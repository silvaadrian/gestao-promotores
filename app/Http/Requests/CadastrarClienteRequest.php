<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastrarClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:120'],
            'cidade' => ['required', 'string', 'max:100'],
            'estado' => ['required', 'string', 'alpha', 'size:2'],
            'endereco' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Informe o nome do cliente.',
            'nome.max' => 'O nome não pode ter mais de :max caracteres.',
            'cidade.required' => 'Informe a cidade.',
            'cidade.max' => 'A cidade não pode ter mais de :max caracteres.',
            'estado.required' => 'Informe a sigla do estado.',
            'estado.alpha' => 'A sigla do estado deve conter somente letras.',
            'estado.size' => 'A sigla do estado deve ter exatamente :size letras.',
            'endereco.max' => 'O endereço não pode ter mais de :max caracteres.',
        ];
    }
}
