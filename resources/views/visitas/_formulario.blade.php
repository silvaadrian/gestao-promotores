<label for="promotor_id">Promotor</label>
<select id="promotor_id" name="promotor_id" required>
  <option value="">Selecione um promotor</option>
  @foreach ($promotores as $promotor)
  <option
    value="{{ $promotor->id }}"
    @selected(old('promotor_id', $visita?->promotor_id ?? $promotorSugeridoId ?? null) == $promotor->id)
    >
    {{ $promotor->nome }}
  </option>
  @endforeach
</select>
@error('promotor_id')
<p class="erro">{{ $message }}</p>
@enderror

<label for="cliente_id">Cliente</label>
<select id="cliente_id" name="cliente_id" required>
  <option value="">Selecione um cliente</option>
  @foreach ($clientes as $cliente)
  <option
    value="{{ $cliente->id }}"
    @selected(old('cliente_id', $visita?->cliente_id ?? $clienteSelecionadoId ?? null) == $cliente->id)
    >
    {{ $cliente->nome }} — {{ $cliente->cidade }}/{{ $cliente->estado }}
  </option>
  @endforeach
</select>
@error('cliente_id')
<p class="erro">{{ $message }}</p>
@enderror

<label for="agendada_para">Data e hora</label>
<input
  id="agendada_para"
  name="agendada_para"
  type="datetime-local"
  value="{{ old('agendada_para', $visita?->agendada_para?->format('Y-m-d\TH:i')) }}"
  required>
@error('agendada_para')
<p class="erro">{{ $message }}</p>
@enderror

<label for="status">Status</label>
<select id="status" name="status" required>
  <option value="agendada" @selected(old('status', $visita?->status ?? 'agendada') === 'agendada')>
    Agendada
  </option>
  <option value="realizada" @selected(old('status', $visita?->status) === 'realizada')>
    Realizada
  </option>
  <option value="cancelada" @selected(old('status', $visita?->status) === 'cancelada')>
    Cancelada
  </option>
</select>
@error('status')
<p class="erro">{{ $message }}</p>
@enderror

<label for="observacoes">Observações</label>
<textarea id="observacoes" name="observacoes">{{ old('observacoes', $visita?->observacoes ?? '') }}</textarea>
@error('observacoes')
<p class="erro">{{ $message }}</p>
@enderror