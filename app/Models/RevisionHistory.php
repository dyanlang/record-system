<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'uID',
        'toID',
        'revision_amount',
        'revision_purpose',
        'revision_offering_name',
        'revision_type',
        'revision_date',
    ];

    protected $primaryKey = 'revID';
    protected $table = 'revision_tb';
    public $timestamps = true;

    public function tithesOffer()
    {
        $this->belongsTo(TithesOffer::class);
    }
}
