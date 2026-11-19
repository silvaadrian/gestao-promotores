<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastrarClienteRequest;
use App\Http\Requests\AtualizarClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClienteController extends Controller
{
    public function index(): View
    {
        $clientes = Cliente::query()
            ->orderBy('nome')
            ->get();

        return view('clientes.index', compact('clientes'));
    }

    public function create(): View
    {
        return view('clientes.create');
    }

    public function store(CadastrarClienteRequest $requisicao): RedirectResponse
    {
        $dadosValidados = $requisicao->validated();
        $dadosValidados['estado'] = strtoupper($dadosValidados['estado']);

        Cliente::create($dadosValidados);

        return redirect()
            ->route('clientes.index')
            ->with('sucesso', 'Cliente cadastrado com sucesso.');
    }

    public function edit(Cliente $cliente): View
    {
        return view('clientes.editar', [
            'cliente' => $cliente,
        ]);
    }

    public function update(
        AtualizarClienteRequest $requisicao,
        Cliente $cliente
    ): RedirectResponse {
        $dados = $requisicao->validated();
        $dados['estado'] = mb_strtoupper($dados['estado']);
        $dados['ativo'] = (bool) $dados['ativo'];

        $cliente->update($dados);

        return redirect()
            ->route('clientes.index')
            ->with('sucesso', 'Cliente atualizado com sucesso.');
    }
}
