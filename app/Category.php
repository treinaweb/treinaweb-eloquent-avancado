<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Mapeia o relacionamento com a tabela de posts
     *
     * @return void
     */
    public function posts()
    {
        return $this->belongsTomany('App\Post', 'category_post', 'category_id', 'post_id')
                    ->withTimestamps();
    }
}
