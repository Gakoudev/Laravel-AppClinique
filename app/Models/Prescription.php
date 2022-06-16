<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'detail',
        'quantite',
        'date',
        'patients_id',
        'users_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
