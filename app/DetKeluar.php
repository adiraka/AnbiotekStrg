<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class DetKeluar extends Model
{
    protected $table = 'det_keluar';

    protected $fillable = [
        'id', 'keluar_id', 'barang_kode', 'stokawal', 'stokeluar', 'stokakhir', 'harga', 'subtot'
    ];

    public function keluar()
    {
        return $this->belongsTo('Anbiotek\Keluar', 'keluar_id', 'id');
    }

    public function barang()
    {
        return $this->belongsTo('Anbiotek\Barang', 'barang_kode', 'kode');
    }
}
