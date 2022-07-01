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
        'ordonances_id',
    ];

    public function ordonance()
    {
        return $this->belongsTo(Ordonance::class,'ordonances_id');
    }
    
}
