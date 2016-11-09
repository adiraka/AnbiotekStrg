<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    protected $table = 'masuk';

    protected $fillable = [
        'id', 'user_id', 'nobon', 'tglmasuk', 'totbay', 'ket'
    ];

    public function user()
    {
        return $this->belongsTo('Anbiotek\User', 'user_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany('Anbiotek\DetMasuk', 'masuk_id', 'id');
    }
}
