<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promotor extends Model
{
    protected $table = 'promotores';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'ativo',
    ];

    public function visitas(): HasMany
    {
        return $this->hasMany(Visita::class, 'promotor_id');
    }
}
