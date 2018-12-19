<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   /**
   * Libera definição de dados em massa
   *
   * @var array
   */
  protected $fillable = ['title', 'content'];

  /**
   * Esconde os campos na serialização
   */
  //protected $hidden = ['title'];

  /**
   * Mostra os campos na serialização
   *
   * @var array
   */
  protected $visible = ['title', 'content'];

  /**
   * Mapeia o relacionamento com o model de posts
   *
   * @return void
   */
   public function post()
   {
     return $this->belongsTo('App\Post', 'post_id', 'id');
   }

   /**
    * Define titulo com primeira letra maiuscula
    *
    * @param [type] $value
    * @return void
    */
   public function setTitleAttribute($value)
   {
     $this->attributes['title'] = ucfirst($value);
   }
}
