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
        return $this->belongsTo(Patient::class,'patients_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }
    
    public function facture()
    {
        return $this->belongsTo(Facture::class,'factures_id');
    }
}
