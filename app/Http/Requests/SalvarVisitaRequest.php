<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalvarVisitaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'promotor_id' => ['required', 'integer', 'exists:promotores,id'],
            'cliente_id' => ['required', 'integer', 'exists:clientes,id'],
            'agendada_para' => ['required', 'date'],
            'status' => ['required', 'in:agendada,realizada,cancelada'],
            'observacoes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'promotor_id.required' => 'Selecione um promotor.',
            'promotor_id.exists' => 'O promotor selecionado não foi encontrado.',
            'cliente_id.required' => 'Selecione um cliente.',
            'cliente_id.exists' => 'O cliente selecionado não foi encontrado.',
            'agendada_para.required' => 'Informe a data e a hora da visita.',
            'agendada_para.date' => 'Informe uma data e hora válidas.',
            'status.required' => 'Selecione o status da visita.',
            'status.in' => 'O status selecionado não é válido.',
            'observacoes.string' => 'As observações devem ser um texto.',
        ];
    }
}
