<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'parent_id'=>$this->parent_id,
            'title'=>$this->title,
            'body'=>$this->body,
            'photo'=>$this->photo,
            'user_id'=>$this->user_id,
            'post_id'=>$this->post_id,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}
