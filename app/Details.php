<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    protected $fillable = ['status', 'visibility'];

    /**
     * Mapeia o relacionamento com o model post
     *
     * @return void
     */
    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }
}
