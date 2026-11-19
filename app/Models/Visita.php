<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visita extends Model
{
    protected $table = 'visitas';

    protected $fillable = [
        'promotor_id',
        'cliente_id',
        'agendada_para',
        'status',
        'observacoes',
    ];

    protected $casts = [
        'agendada_para' => 'datetime',
    ];

    public function promotor(): BelongsTo
    {
        return $this->belongsTo(Promotor::class, 'promotor_id');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
