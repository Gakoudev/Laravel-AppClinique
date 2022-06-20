<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedent extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'detail',
        'patient',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
}
