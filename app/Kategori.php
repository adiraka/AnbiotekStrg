<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'id', 'nmkategori'
    ];
}
