<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    use HasUuids;

    public function shops(): BelongsToMany
    {
        return $this->belongsToMany(Shop::class);
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class);
    }
}
