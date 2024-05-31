<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bus extends Model
{
    use HasFactory;




    protected $fillable = [
        'deriver',
        'capacity',
    ];

    public function trip(): HasMany
    {
        return $this->hasMany(Trip::class);
    }


}
