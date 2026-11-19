<?php

namespace App\Http\Controllers;

use App\Http\Requests\FiltrarRelatorioPromotorRequest;
use App\Models\Promotor;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class RelatorioPromotorController extends Controller
{
    public function index(FiltrarRelatorioPromotorRequest $requisicao): View
    {
        [$dataInicial, $dataFinal] = $this->obterPeriodo($requisicao);

        return view('relatorios.promotores', [
            'promotores' => $this->buscarPromotores($dataInicial, $dataFinal),
            'dataInicial' => $dataInicial,
            'dataFinal' => $dataFinal,
        ]);
    }

    public function exportarCsv(
        FiltrarRelatorioPromotorRequest $requisicao
    ): StreamedResponse {
        [$dataInicial, $dataFinal] = $this->obterPeriodo($requisicao);
        $promotores = $this->buscarPromotores($dataInicial, $dataFinal);

        return response()->streamDownload(function () use ($promotores): void {
            $arquivo = fopen('php://output', 'wb');

            fwrite($arquivo, "\xEF\xBB\xBF");

            fputcsv(
                $arquivo,
                ['Promotor', 'Situação', 'Agendadas', 'Realizadas', 'Canceladas'],
                ';',
                '"',
                ''
            );

            foreach ($promotores as $promotor) {
                fputcsv(
                    $arquivo,
                    [
                        $this->protegerTextoCsv($promotor->nome),
                        $promotor->ativo ? 'Ativo' : 'Inativo',
                        $promotor->visitas_agendadas,
                        $promotor->visitas_realizadas,
                        $promotor->visitas_canceladas,
                    ],
                    ';',
                    '"',
                    ''
                );
            }

            fclose($arquivo);
        }, 'relatorio-promotores.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function obterPeriodo(
        FiltrarRelatorioPromotorRequest $requisicao
    ): array {
        $dados = $requisicao->validated();

        return [
            $dados['data_inicial'] ?? null,
            $dados['data_final'] ?? null,
        ];
    }

    private function buscarPromotores(
        ?string $dataInicial,
        ?string $dataFinal
    ): Collection {
        $contarVisitasNoPeriodo = function (string $status) use (
            $dataInicial,
            $dataFinal
        ): Closure {
            return function (Builder $consulta) use (
                $status,
                $dataInicial,
                $dataFinal
            ): void {
                $consulta->where('status', $status);

                if ($dataInicial !== null) {
                    $consulta->whereDate('agendada_para', '>=', $dataInicial);
                }

                if ($dataFinal !== null) {
                    $consulta->whereDate('agendada_para', '<=', $dataFinal);
                }
            };
        };

        return Promotor::query()
            ->withCount([
                'visitas as visitas_agendadas' => $contarVisitasNoPeriodo('agendada'),
                'visitas as visitas_realizadas' => $contarVisitasNoPeriodo('realizada'),
                'visitas as visitas_canceladas' => $contarVisitasNoPeriodo('cancelada'),
            ])
            ->orderByDesc('visitas_realizadas')
            ->orderBy('nome')
            ->get();
    }

    private function protegerTextoCsv(string $texto): string
    {
        if (preg_match('/^[\t\r\n ]*[=+\-@]/', $texto) === 1) {
            return "'" . $texto;
        }

        return $texto;
    }
}
