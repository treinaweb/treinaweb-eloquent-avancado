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
     * Usa Soft deleting
     */
    use SoftDeletes;

    /**
     * bloqueia definição de dados em massa
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Define os campos do tipo data
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Converte tipos de dados
     *
     * @var array
     */
    protected $casts = [
        'approved' => 'boolean'
    ];

    /**
     * Relaciona os eventos ao model
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => PostCreated::class
    ];

    /**
     * Anexa campo criado via assessor a serialização
     *
     * @var array
     */
    protected $appends = ['summary_content'];

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

    /**
     * Limita a quantidade de caracteres
     *
     * @param [type] $value
     * @return void
     */
    // public function getContentAttribute($value)
    // {
    //     return mb_strimwidth($value, 0, 30, "...");
    // }

    public function getSummaryContentAttribute()
    {
        return mb_strimwidth($this->content, 0, 30, "...");
    }



}
