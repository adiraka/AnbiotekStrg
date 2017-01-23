<?php

namespace Anbiotek;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    protected $fillable = [
    	'id', 'user_id', 'judul', 'teks', 'created_at', 'updated_at'
    ];

    public function user()
    {
    	return $this->belongsTo('Anbiote\User', 'user_id', 'id');
    }
}
