<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'detail',
        'prix',
        'date',
        'patients_id',
        'users_id',
        'factures_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}
