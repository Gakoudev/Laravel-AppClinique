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
        'patients_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patients_id');
    }
    
}
