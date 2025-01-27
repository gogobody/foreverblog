<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    protected $dates = ['abnormaled_at', 'adopted_at', 'updated_at', 'created_at'];

    protected $appends = ['avatar'];

    protected $fillable = ['name', 'email', 'link', 'feed_link', 'feed_status', 'message', 'status', 'history', 'views', 'adopted_at', 'updated_at', 'created_at'];

    const STATUS = ['审核中', '审核通过', '未通过', '疑似异常', '异常'];

    const FEED_STATUS = ['未填写', '正常', '抓取异常', '未检测'];

    const IS_NOTIFY = ['否', '是'];

    public function getAvatarAttribute()
    {
        return gravatar($this->email);
    }

    public function datelines()
    {
        return $this->hasMany(Dateline::class, 'blog_id', 'id')->orderBy('created_at', 'asc');
    }

    public function comments($page = 10)
    {
        return $this->hasMany(Comment::class, 'foreign_id', 'id')
            ->with('replies')
            ->orderBy('created_at', 'desc')
            ->where('parent_id', 0)
            ->where('type', 'blog')
            ->where('status', 1)
            ->paginate($page);
    }

    public function feeds()
    {
        return $this->hasMany(Feed::class, 'blog_id', 'id');
    }

    public function getCommentCount()
    {
        return Comment::where('foreign_id', $this->id)
            ->where('type', 'blog')
            ->where('status', 1)
            ->count();
    }

    public function getDetailUrlAttribute($value)
    {
        $id = $this->slug ?: $this->id;
        return url("/blog/{$id}.html");
    }
}
