<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('titulo', 'Gestão de Promotores')</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f4f6f8;
      color: #20252b;
    }

    main {
      max-width: 900px;
      margin: 40px auto;
      padding: 24px;
      background: #fff;
      border-radius: 8px;
    }

    a,
    button {
      display: inline-block;
      padding: 10px 14px;
      border: 0;
      border-radius: 5px;
      background: #2457a7;
      color: #fff;
      text-decoration: none;
      cursor: pointer;
    }

    label {
      display: block;
      margin-top: 16px;
    }

    input {
      box-sizing: border-box;
      width: 100%;
      max-width: 480px;
      padding: 9px;
      margin-top: 5px;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    .erro {
      color: #b42318;
    }

    .sucesso {
      margin: 16px 0;
      color: #18794e;
    }
  </style>
</head>

<body>
  <main>
    <nav>
      @auth
      <a href="{{ route('painel') }}">Painel</a>
      <a href="{{ route('relatorios.promotores') }}">Relatório de promotores</a>
      <a href="{{ route('promotores.index') }}">Promotores</a>
      <a href="{{ route('clientes.index') }}">Clientes</a>
      <a href="{{ route('visitas.index') }}">Visitas</a>

      <span>{{ auth()->user()->name }}</span>

      <form action="{{ route('logout') }}" method="POST" style="display: inline">
        @csrf
        <button type="submit">Sair</button>
      </form>
      @else
      <a href="{{ route('login') }}">Entrar</a>
      <a href="{{ route('cadastro') }}">Criar conta</a>
      @endauth
    </nav>
    @yield('conteudo')
  </main>
</body>

</html>