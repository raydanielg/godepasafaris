<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Comment extends Model
{
    protected $fillable = ['post_id', 'name', 'email', 'rating', 'comment', 'is_approved'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
