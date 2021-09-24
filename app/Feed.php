<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $table = 'feed';

    protected $fillable = ['blog_id', 'title', 'author', 'link', 'desc', 'updated_at', 'created_at'];

    public $timestamps = false;

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
}
