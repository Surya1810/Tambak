<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kolam extends Model
{
    use HasFactory;

    public function tambak(): BelongsTo
    {
        return $this->belongsTo(Tambak::class, 'tambak_id');
    }
}
