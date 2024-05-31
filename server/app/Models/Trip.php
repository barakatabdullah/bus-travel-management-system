<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trip extends Model
{
    use HasFactory;



    protected $fillable = [
        'name', 'active', 'bus_id', 'time'
    ];


    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }


    public function ticket() : HasMany{
        return $this->hasMany(Ticket::class);
    }
}
