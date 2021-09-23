<?php

namespace App\Http\Controllers\Api\V1;

use App\Blog;
use App\Http\Controllers\Controller;
use App\Http\Resources\Blogs;
use App\Http\Resources\BlogsCollection;
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

    /**
     * 获取博客函数
     * 参数：
     * secret: env 中 querySecret 配置的值，外部访问该 api 的唯一凭证
     *
     */
    public function queryAllblogs(Request $request)
    {
        $querySecret = env('QUERY_SECRET');
        if (!$querySecret) {
            return $this->error('未配置 QUERY_SECRET ');
        }
        $qsec = $request->input('secret');
        if ($qsec != $querySecret) {
            return $this->error('secret 错误');
        }
        $blogs = new BlogsCollection(Blog::query()->where('status', 1)->paginate());
        return $this->result($blogs);
    }
}
