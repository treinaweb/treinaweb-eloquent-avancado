<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
     * Libera definição de dados em massa
     *
     * @var array
     */
    protected $fillable = ['value'];

    /**
     * Método de relação com post ou user
     *
     * @return void
     */
    public function ratingable()
    {
        return $this->morphTo();
    }
}
