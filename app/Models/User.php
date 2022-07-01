<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prenom',
        'nom',
        'telephone',
        'etat',
        'email',
        'password',
        'roles_id',
    ];
    


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function patient()
    {
        return $this->hasMany(Patient::class);
    }

    public function rendezvous()
    {
        return $this->hasMany(Rendezvous::class);
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
    
    public function role()
    {
        return $this->belongsTo(Role::class,'roles_id');
    }
}
