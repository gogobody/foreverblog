<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dateline extends Model
{
    protected $table = 'dateline';

    protected $fillable = ['blog_id', 'date', 'content', 'status'];

    protected $appends = ['join_date'];

    const STATUS = ['待审核', '审核通过', '审核不通过'];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }

    public function getJoinDateAttribute()
    {
        return date('Y/m/d', strtotime($this->date));
    }
}
