
# Gestão de Promotores

Aplicação web para organizar promotores, clientes e visitas, com sugestões de promotor baseadas no histórico de visitas realizadas.

## Funcionalidades

- Cadastro, edição e ativação ou desativação de promotores.
- Cadastro, edição e ativação ou desativação de clientes.
- Agendamento, edição e acompanhamento de visitas.
- Filtros de visitas por promotor, status e período.
- Sugestão de promotor com base no histórico de visitas realizadas para o cliente.
- Painel com totais e próximas visitas.
- Relatório de visitas por promotor, com filtro de período e exportação CSV.
- Cadastro, login e logout de usuários.

## Tecnologias

- PHP 8.3 ou superior
- Laravel 13
- SQLite
- Composer
- [Biblioteca Classificadora](https://github.com/silvaadrian/biblioteca-classificadora)

## Instalação

Clone o repositório e acesse a pasta do projeto:

```powershell
git clone URL_DO_REPOSITORIO
Set-Location gestao-promotores
```

Instale as dependências e configure o ambiente:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
```

Confirme no arquivo `.env` que o banco usa SQLite:

```env
DB_CONNECTION=sqlite
```

Se o arquivo do banco ainda não existir, crie-o no PowerShell:

```powershell
if (-not (Test-Path 'database/database.sqlite')) {
    New-Item -ItemType File -Path 'database/database.sqlite'
}
```

Crie as tabelas e inicie a aplicação:

```powershell
php artisan migrate
php artisan serve
```

Acesse `http://127.0.0.1:8000` e crie uma conta pela tela de cadastro.

## Sugestões de promotor

As sugestões usam o histórico de visitas marcadas como realizadas. Cadastre promotores e clientes, registre visitas e marque algumas como realizadas. Depois, ao criar uma visita para um cliente com histórico, a aplicação poderá sugerir o promotor associado.

## Relatórios

O relatório de promotores fica disponível em:

```text
/relatorios/promotores
```

É possível filtrar por período e baixar os resultados em CSV.

## Banco de dados

O projeto usa SQLite por padrão. O arquivo local `database/database.sqlite` guarda os dados da aplicação e não deve ser publicado no repositório.
