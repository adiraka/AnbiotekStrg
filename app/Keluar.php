<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    protected $table = 'keluar';

    protected $fillable = [
        'id', 'user_id', 'nobon', 'tglkeluar', 'totbay', 'ket'
    ];
}
