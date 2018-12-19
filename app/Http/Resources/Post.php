<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'codigo'    => $this->id,
            'titulo'    => $this->title,
            'conteudo'  => $this->content,
            'aprovado'  => $this->approved
        ];
    }
}
