<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero',
        'date',
        'etat',
        'patient',
        'user',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function traitement()
    {
        return $this->hasMany(Traitement::class);
    }
    
    public function ordonance()
    {
        return $this->hasMany(Ordonance::class);
    }
}
