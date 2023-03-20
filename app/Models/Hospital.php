<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_name',
        'phone_no',
        'address',
        'slots',
        'ward_id',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'hospital_id');
    }

    public function records(): HasMany
    {
        return $this->hasMany(Record::class, 'hospital_id');
    }

    public function provider(): HasMany
    {
        return $this->hasMany(Healthcare_provider::class, 'hospital_id');
    }

    public function subCounty(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }
}
