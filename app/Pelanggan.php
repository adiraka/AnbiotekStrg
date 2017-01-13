<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $fillable = [
    	'id', 'nmpelanggan', 'telepon', 'alamat'
    ];

    public function keluar()
    {
    	return $this->hasMany('Anbiotek\Keluar', 'pelanggan_id', 'id');
    }
}
