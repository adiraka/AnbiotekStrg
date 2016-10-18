<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    protected $table = 'masuk';

    protected $fillable = [
        'id', 'user_id', 'nobon', 'tglmasuk', 'totbay', 'ket'
    ];
}
