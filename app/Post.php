<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Mapeia o relacionamento com o model details
     *
     * @return void
     */
    public function details()
    {
        return $this->hasOne('App\Details', 'post_id', 'id')
                    ->withDefault(function($details) {
                        $details->status = 'rascunho';
                        $details->visibility = 'privado';
                    });
    }

    /**
     * Mapeia o relacionamento com o model de comentários
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }

    /**
     * Mapeia o relacionamento com o model de categorias
     *
     * @return void
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_post', 'post_id', 'category_id')
                    ->withTimestamps();
    }

}
