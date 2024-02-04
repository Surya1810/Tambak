<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kolam extends Model
{
    use HasFactory;

    public function tambak(): BelongsTo
    {
        return $this->belongsTo(Tambak::class, 'tambak_id');
    }

    public function bibit(): HasMany
    {
        return $this->hasMany(Bibit::class);
    }

    public function sampling(): HasMany
    {
        return $this->hasMany(Sampling::class);
    }

    public function pakan(): HasMany
    {
        return $this->hasMany(Pakan::class);
    }
}
