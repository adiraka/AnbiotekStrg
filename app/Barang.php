<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'kode', 'nmbarang', 'kategori_id', 'merk', 'satuan_id', 'stock', 'ket'
    ];
}
