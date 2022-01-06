<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=["user_id","title","subject","photo","slug"];
    protected $dates=['deleted_at'];


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getFeaturedAttribute($photo){
        return asset($photo);

    }


    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }


    public function comments()
    {
        return $this->belongsToMany('App\Models\Comment');
    }
}
