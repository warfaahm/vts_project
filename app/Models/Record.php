<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'next_due_date',
        'dose_no',
        'patient_id',
        'dependent_id',
        'vaccine_id',
        'hospital_id',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function dependent(): BelongsTo
    {
        return $this->belongsTo(Dependent::class, 'dependent_id');
    }

    public function vaccine(): BelongsTo
    {
        return $this->belongsTo(Vaccine::class, 'vaccine_id');
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

}
