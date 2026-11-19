<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class FiltrarRelatorioPromotorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $regrasDataFinal = ['nullable', 'date_format:Y-m-d'];

        if ($this->filled('data_inicial')) {
            $regrasDataFinal[] = 'after_or_equal:data_inicial';
        }

        return [
            'data_inicial' => ['nullable', 'date_format:Y-m-d'],
            'data_final' => $regrasDataFinal,
        ];
    }

    public function messages(): array
    {
        return [
            'data_inicial.date_format' => 'Informe uma data inicial válida.',
            'data_final.date_format' => 'Informe uma data final válida.',
            'data_final.after_or_equal' => 'A data final deve ser igual ou posterior à inicial.',
        ];
    }
}
