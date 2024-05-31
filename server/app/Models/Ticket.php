<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','description', 'status','trip_id','user_id'
    ];



    public function trip(): HasMany
    {
        return $this->hasMany(Trip::class);
    }


    public function bus(): HasMany
    {
        return $this->hasMany(Bus::class);
    }

}
