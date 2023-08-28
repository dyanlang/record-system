<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'uID',
        'logSTAT',
        'uIN',
        'uOUT',

    ];

    protected $primaryKey = 'logID';
    protected $table = 'log_tb';

    public function users()
    {
        $this->belongsTo(User::class, 'uID', 'uID');
    }


    
}
