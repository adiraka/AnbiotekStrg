<?php

namespace Anbiotek;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    protected $table = 'masuk';

    protected $fillable = [
        'id', 'user_id', 'distributor_id', 'nobon', 'supplier', 'tglmasuk', 'totbay', 'status','tgllunas', 'ket'
    ];

    // public function getTglMasukAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d F Y');
    // }

    // public function getTglLunasAttribute($value)
    // {
    //     if ($value == NULL) {
    //         return '-';
    //     }
    //     return Carbon::parse($value)->format('d F Y');
    // }

    public function user()
    {
        return $this->belongsTo('Anbiotek\User', 'user_id', 'id');
    }

    public function distributor()
    {
        return $this->belongsTo('Anbiotek\Distributor', 'distributor_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany('Anbiotek\DetMasuk', 'masuk_id', 'id');
    }
}
