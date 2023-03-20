<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaccine_name',
        'manufacturer',
        'contains',
        'dosage',
        'age_range',
        'disease_id',
        'dose_1_duration',
        'dose_2_duration',
        'dose_3_duration',
        'validity_duration',
        'price',
    ];

    public function records(): HasMany
    {
        return $this->hasMany(Record::class, 'vaccine_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'vaccine_id');
    }

    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class, 'disease_id');
    }
}