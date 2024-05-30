<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Trip;

class Bus extends Model
{
    use HasFactory;

    public function trip(): HasMany
    {
        return $this->hasMany(Trip::class);
    }


    protected $fillable = [
        'deriver',
        'capacity',
    ];
}
