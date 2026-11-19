<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class AtualizarClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'cidade' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'size:2'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'ativo' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Informe o nome do cliente.',
            'nome.max' => 'O nome não pode passar de 255 caracteres.',
            'cidade.required' => 'Informe a cidade.',
            'cidade.max' => 'A cidade não pode passar de 255 caracteres.',
            'estado.required' => 'Informe a UF.',
            'estado.size' => 'A UF deve ter exatamente 2 caracteres.',
            'endereco.max' => 'O endereço não pode passar de 255 caracteres.',
            'ativo.required' => 'Informe se o cliente está ativo.',
            'ativo.boolean' => 'A situação do cliente é inválida.',
        ];
    }
}
