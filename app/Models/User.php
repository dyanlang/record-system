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
        'firstname',
        'middlename',
        'lastname',
        'birthday',
        'user_mobile_number',
        'user_street',
        'user_barangay',
        'user_city',
        'user_zip',
        'username',
        'email',
        'password',
        'user_image',
        'user_status',
        'user_access',
        'user_type',

    ];

    protected $primaryKey = 'uID';
    protected $table = 'users_tb';

    public $timestamps = true;

    // public function setUaccessAttribute($value)
    // {
    //     $this->attributes['uAccess'] = json_encode($value);
    // }

    // public function getUaccessAttribute($value)
    // {
    //     return $this->attributes['uAccess'] = json_decode($value);
    // }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
    
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
        // 'uAccess' => 'array',
    ];
}
