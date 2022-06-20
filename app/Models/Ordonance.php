<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonance extends Model
{
    use HasFactory;
    protected $fillable = [
        'etat',
        'patient',
        'user',
        'facture',
    ];
    
    public function prescription()
    {
        return $this->hasMany(Prescription::class);
    }
    
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
