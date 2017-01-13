<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Pelunasan extends Model
{
    protected $table = 'pelunasan';

    protected $fillable = [
    	'id', 'transaksi_id', 'status', 'tgllunas'
    ];

    public function masuk()
    {
    	return $this->belongsTo('Anbiotek\Masuk', 'transaksi_id', 'id');
    }

    public function keluar()
    {
    	return $this->belongsTo('Anbiotek\Keluar', 'transaksi_id', 'id');
    }
}
