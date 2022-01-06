<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['title','body','user_id','post_id','parent_id'];
    use HasFactory;


    /**
     * Get the user that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }


    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    /**
     * Get the replies that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function replies()
    {
        return $this->belongsToMany('App\Models\Comment', 'parent_id');
    }
}
