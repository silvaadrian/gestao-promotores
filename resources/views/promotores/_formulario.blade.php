<label for="nome">Nome</label>
<input
  id="nome"
  name="nome"
  type="text"
  value="{{ old('nome', $promotor?->nome ?? '') }}"
  maxlength="100"
  required>
@error('nome')
<p class="erro">{{ $message }}</p>
@enderror

<label for="email">E-mail</label>
<input
  id="email"
  name="email"
  type="email"
  value="{{ old('email', $promotor?->email ?? '') }}"
  maxlength="255">
@error('email')
<p class="erro">{{ $message }}</p>
@enderror

<label for="telefone">Telefone</label>
<input
  id="telefone"
  name="telefone"
  type="text"
  value="{{ old('telefone', $promotor?->telefone ?? '') }}"
  maxlength="30">
@error('telefone')
<p class="erro">{{ $message }}</p>
@enderror
@if (isset($promotor) && $promotor->exists)
<input type="hidden" name="ativo" value="0">

<label>
  <input
    type="checkbox"
    name="ativo"
    value="1"
    @checked(old('ativo', $promotor->ativo))>
  Promotor ativo
</label>

@error('ativo')
<p class="erro">{{ $message }}</p>
@enderror
@endif