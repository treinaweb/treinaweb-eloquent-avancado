<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = ['title', 'content'];

  /**
   * Mapeia o relacionamento com o model de posts
   *
   * @return void
   */
   public function post()
   {
     return $this->belongsTo('App\Post', 'post_id', 'id');
   }
}
