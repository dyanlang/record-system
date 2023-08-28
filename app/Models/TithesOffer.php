<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TithesOffer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uID',
        'member_ID',
        'tithes_offer_group_type',
        'tithes_offer_amount',
        'tithes_offer_type',
        'tithes_offer_purpose',
        'tithes_offer_file',
        'offering_name',
        'tithes_offer_read',
        'tithes_offer_approval',
        'tithes_offer_status',
    ];

    protected $primaryKey = 'toID';
    protected $table = 'tithes_offer_tb';
    public $timestamps = true;

    public function users()
    {
        $this->belongsTo(User::class, 'uID', 'uID');
    }

    public function del()
    {
        $this->hasMany(Delete::class);
    }

    public function dsment()
    {
        $this->hasMany(Disbursement::class);
    }


}
