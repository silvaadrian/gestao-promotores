<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FiltrarVisitasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'promotor_id' => ['nullable', 'integer', 'exists:promotores,id'],
            'status' => ['nullable', 'in:agendada,realizada,cancelada'],
            'data_inicio' => ['nullable', 'date'],
            'data_fim' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'promotor_id.exists' => 'O promotor selecionado não foi encontrado.',
            'status.in' => 'Selecione um status válido.',
            'data_inicio.date' => 'Informe uma data inicial válida.',
            'data_fim.date' => 'Informe uma data final válida.',
        ];
    }
}
