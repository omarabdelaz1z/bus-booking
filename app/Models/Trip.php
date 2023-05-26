<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trip extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'source',
        'destination',
        'bus_id',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'source');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'destination');
    }

    public function stops(): BelongsToMany
    {
        return $this->belongsToMany(Station::class)->withPivot(['sequence']);
    }
}
