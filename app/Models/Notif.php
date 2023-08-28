<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notif extends Model
{
    use HasFactory;
    protected $fillable = [

        'nID',
        'uID',
        'type',
        'notif_type',
        'is_read',
       
    ];

    protected $primaryKey = 'nID';
    protected $table = 'notifs';

    public function users()
    {
        $this->belongsTo(User::class, 'uID', 'uID');
    }


}
