<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class VisibleScope implements Scope 
{
  /**
   * Busca posts que estão visiveis no site publico
   *
   * @param Builder $builder
   * @param Model $model
   * @return void
   */
  public function apply(Builder $builder, Model $model)
  {
    $builder->whereHas('details', function ($query) {
      $query->where('status', 'publicado')
            ->where('visibility', 'publico');
    });
  }

}