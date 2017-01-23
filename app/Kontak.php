<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontak';

    protected $fillable = [
    	'id', 'nama', 'email', 'judul', 'pesan', 'created_at', 'updated_at'
    ];
}
