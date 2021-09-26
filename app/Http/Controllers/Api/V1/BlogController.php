<?php

namespace App\Http\Controllers\Api\V1;

use App\Blog;
use App\Feed;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * 监测邮箱和域名是否满足要求
     * result：
     * 1.域名满足，邮箱满足
     * 2.域名满足，邮箱不满足
     * 3.域名不满足，邮箱满足
     * 4.域名不满足，邮箱不满足
     */
    public function check(Request $request)
    {
        $this->validate($request, [
            'email' => ['required'],
            'domain' => ['required'],
        ], [], [
            'email' => '邮箱',
            'domain' => '域名',
        ]);

        $domain = rtrim(str_replace(['http://', 'https://'], ['', ''], $request->domain), '/');
        $domainCount = Blog::query()->where('status', 1)->where('link', 'like', "%{$domain}%")->count();
        $emailCount = Blog::query()->where('status', 1)->where('email', $request->email)->count();
        switch (1) {
            case $domainCount > 0 && $emailCount > 0:
                $result = 1;
                break;
            case $domainCount > 0 && $emailCount == 0:
                $result = 2;
                break;
            case $domainCount == 0 && $emailCount > 0:
                $result = 3;
                break;
            default:
                $result = 4;
        }
        return $this->result(compact('result'));
    }

    public function feeds(Request $request)
    {
        $feeds = Feed::query()->latest()->whereHas('blog', function (Builder $builder) {
            $builder->where('status', 1);
        })->when($request->query('q'), function (Builder $builder, $q) {
            $fields = "concat(IFNULL(`title`,''),IFNULL(`author`,''),IFNULL(`link`,''),IFNULL(`desc`,''))";
            $builder->whereRaw("{$fields} like ?", ["%{$q}%"]);
        })->paginate(30);
        $feeds->getCollection()->each(function (Feed $feed) {
            /** @var Blog $blog */
            $blog = $feed->blog;
            $feed->avatar = $blog->avatar;
            $feed->email = md5(strtolower(trim($blog->email)));
            $feed->setVisible(['id', 'title', 'author', 'avatar', 'email', 'link', 'desc']);
        });
        return $this->success('success', $feeds);
    }
}
