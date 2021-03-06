<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'kode', 'nmbarang', 'kategori_id', 'merk_id', 'satuan_id', 'stock', 'harga_beli', 'expire', 'ket'
    ];

    public function kategori()
    {
        return $this->belongsTo('Anbiotek\Kategori', 'kategori_id', 'id');
    }

    public function satuan()
    {
        return $this->belongsTo('Anbiotek\Satuan', 'satuan_id', 'id');
    }

    public function merk()
    {
        return $this->belongsTo('Anbiotek\Merk', 'merk_id', 'id');
    }

    public function detailMasuk()
    {
        return $this->hasMany('Anbiotek\DetMasuk', 'barang_kode', 'kode');
    }

    public function detailKeluar()
    {
        return $this->hasMany('Anbiotek\DetKeluar', 'barang_kode', 'kode');
    }
}
