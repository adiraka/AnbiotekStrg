<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    protected $table = 'masuk';

    protected $fillable = [
        'id', 'user_id', 'distributor_id', 'nobon', 'supplier', 'tglmasuk', 'totbay', 'status', 'ket'
    ];

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

    public function pelunasan()
    {
        return $this->hasOne('Anbiotek\Pelunasan', 'transaksi_id', 'id');
    }
}
