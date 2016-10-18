<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class DetKeluar extends Model
{
    protected $table = 'det_keluar';

    protected $fillable = [
        'id', 'keluar_id', 'barang_kode', 'stokawal', 'stokkeluar', 'stokakhir', 'harga', 'subtot'
    ]
}
