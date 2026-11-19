<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Promotor;
use App\Models\Visita;
use BibliotecaClassificadora\Classificador;

class SugestaoPromotorService
{
  public function sugerir(Cliente $cliente): ?array
  {
    $visitas = Visita::query()
      ->where('status', 'realizada')
      ->with('cliente')
      ->get();

    if ($visitas->isEmpty()) {
      return null;
    }

    $historico = $visitas
      ->map(function (Visita $visita): array {
        return [
          'descricao' => $visita->cliente->nome,
          'categoria' => (string) $visita->promotor_id,
        ];
      })
      ->all();

    $resultado = (new Classificador($historico))
      ->classificar($cliente->nome);

    $categoria = $resultado['categoria'] ?? null;

    if (
      !is_int($categoria)
      && !(is_string($categoria) && ctype_digit($categoria))
    ) {
      return null;
    }

    $promotor = Promotor::query()->find((int) $categoria);

    if ($promotor === null || !$promotor->ativo) {
      return null;
    }

    return [
      'promotor' => $promotor,
      'apoio_percentual' => $resultado['apoio_percentual'] ?? 0,
      'registros_semelhantes' => $resultado['registros_semelhantes'] ?? 0,
      'evidencias' => $resultado['evidencias'] ?? [],
    ];
  }
}
