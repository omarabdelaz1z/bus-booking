<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trip extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'from_station',
        'to_station',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'from_station');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'to_station');
    }

    public function stops(): BelongsToMany
    {
        return $this->belongsToMany(Station::class)->withPivot(['sequence']);
    }
}
