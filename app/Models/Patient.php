<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero',
        'prenom',
        'nom',
        'telephone',
        'dateN',
        'users_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }

    public function rendezvous()
    {
        return $this->hasMany(Rendezvous::class);
    }
    
    public function antecedent()
    {
        return $this->hasMany(Antecedent::class);
    }
    
    public function ordonance()
    {
        return $this->hasMany(Ordonance::class);
    }
    
    public function facture()
    {
        return $this->hasMany(Facture::class);
    }

    public function traitement()
    {
        return $this->hasMany(Traitement::class);
    }
}
