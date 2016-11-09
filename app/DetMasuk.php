<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class DetMasuk extends Model
{
    protected $table = 'det_masuk';

    protected $fillable = [
        'id', 'masuk_id', 'barang_kode', 'stokawal', 'stokmasuk', 'stokakhir', 'harga', 'subtot',
    ];

    public function masuk()
    {
        return $this->belongsTo('Anbiotek\Masuk', 'masuk_id', 'id');
    }

    public function barang()
    {
        return $this->belongsTo('Anbiotek\Barang', 'barang_kode', 'kode');
    }
}
