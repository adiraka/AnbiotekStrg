<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    protected $table = 'keluar';

    protected $fillable = [
        'id', 'user_id', 'nobon', 'pemesan', 'tglkeluar', 'totbay', 'ket'
    ];

    public function user()
    {
        return $this->belongsTo('Anbiotek\User', 'user_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany('Anbiotek\DetKeluar', 'keluar_id', 'id');
    }
}
