<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class DetMasuk extends Model
{
    protected $table = 'det_masuk';

    protected $fillable = [
        'id', 'masuk_id', 'barang_kode', 'stokawal', 'stokterima', 'stokakhir', 'harga', 'subtot'
    ]
}
