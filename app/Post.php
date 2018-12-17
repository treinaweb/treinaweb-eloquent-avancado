<?php

namespace App;

use App\Scopes\VisibleScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use App\Events\PostCreated;

class Post extends Model
{
    /**
     * Configura itens do model
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderByCreatedAt', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });

        static::addGlobalScope(new VisibleScope);
    }

    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $date = ['deleted_at'];

    protected $dispatchesEvents = [
        'created' => PostCreated::class
    ];

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
                    ->using('App\CategoryPost')
                    ->withTimestamps();
                    //->as('relacao')
                    //->wherePivot('active', 1);
                    //->withPivot('username');
    }

    /**
     * Retorna as avaliacoes relacionas com o post
     *
     * @return void
     */
    public function ratings()
    {
        return $this->morphMany('App\Rating', 'ratingable');
    }

    /**
     * Verifica se o post é aprovado
     *
     * @param [type] $query
     * @return void
     */
    public function scopeIsApproved($query)
    {
        return $query->where('approved', 1);
    }

    /**
     * Verifica o post com base no parametro dinamico
     *
     * @param [type] $query
     * @param [type] $approved
     * @return void
     */
    public function scopeApproved($query, $approved)
    {
        return $query->where('approved', $approved);
    }

    /**
     * Filtra posts com categorias relacionadas
     *
     * @param [type] $query
     * @return void
     */
    public function scopeHasCategories($query)
    {
        return $query->whereHas('categories');
    }

}
