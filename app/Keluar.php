<?php

namespace Anbiotek;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    protected $table = 'keluar';

    protected $fillable = [
        'id', 'user_id', 'pelanggan_id', 'nobon', 'tglkeluar', 'totbay', 'status', 'tgllunas', 'ket'
    ];

    // public function getTglKeluarAttribute($value)
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

    public function pelanggan()
    {
        return $this->belongsTo('Anbiotek\Pelanggan', 'pelanggan_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany('Anbiotek\DetKeluar', 'keluar_id', 'id');
    }
}
