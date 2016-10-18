<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan';

    protected $fillable = [
        'id', 'nmsatuan'
    ];
}
