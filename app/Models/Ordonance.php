<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonance extends Model
{
    use HasFactory;
    protected $fillable = [
        'etat',
        'patients_id',
        'users_id',
        'factures_id',
    ];
    
    public function prescription()
    {
        return $this->hasMany(Prescription::class);
    }
    
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
