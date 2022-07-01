<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    use HasFactory;
    protected $fillable = [
        'dateRV',
        'detail',
        'etat',
        'patients_id',
        'users_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patients_id');
    }
}
