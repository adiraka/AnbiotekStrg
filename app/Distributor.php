<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = 'distributor';

    protected $fillable = [
    	'id', 'nmdistributor', 'telepon', 'alamat'
    ];

    public function masuk() 
    {
    	return $this->hasMany('App\Anbiotek', 'distributor_id', 'id');
    }
}
