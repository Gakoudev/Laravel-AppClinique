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
        'patients_id',
        'users_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patients_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
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
