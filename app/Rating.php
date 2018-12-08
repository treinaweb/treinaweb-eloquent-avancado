<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
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
