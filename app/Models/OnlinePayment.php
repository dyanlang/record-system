<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'uID',
        'on_type',
        'on_image',
        'on_number',
        'on_status',
        'on_delete_status',
    ];

    protected $primaryKey = 'oID';
    protected $table = 'online_payment_tb';
    public $timestamps = true;
}
