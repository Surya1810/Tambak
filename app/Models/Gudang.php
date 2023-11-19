<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Gudang extends Model
{
    use HasFactory;

    public function owner(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
