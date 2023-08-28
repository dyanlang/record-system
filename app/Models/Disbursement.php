<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uID',
        'disbursement_type',
        'disbursement_amount',
        'disbursement_purpose',
        'disbursement_file',
        'disbursement_image_description',
        'disbursement_status',
        'disbursement_delete_status',
    ];

    protected $primaryKey = 'dsID';
    protected $table = 'disbursement_tb';
    public $timestamps = true;

    public function tithesOffer()
    {
        $this->belongsTo(TithesOffer::class);
    }

    public function del()
    {
        $this->hasMany(Disbursement::class);
    }

}
