<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hutang extends Model
{
    use HasFactory;

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(supplier::class, 'supplier_id');
    }
    public function akun(): BelongsTo
    {
        return $this->belongsTo(akun::class, 'akun_id');
    }

    protected $casts = [
        'tempo' => 'datetime'
    ];
}
