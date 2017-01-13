<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    protected $table = 'merk';

    protected $fillable = [
    	'id', 'nmmerk'
    ];

    public function barang()
    {
    	return $this->hasMany('Anbiotek\Barang', 'merk_id', 'merk');
    }
}
