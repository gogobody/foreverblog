<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Feed;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function feeds(Request $request)
    {
        $s = $request->input('s');
        $feeds = Feed::query()->when($s, function (Builder $builder, $s) {
            $fields = "concat(IFNULL(`title`,''),IFNULL(`author`,''),IFNULL(`link`,''),IFNULL(`desc`,''))";
            $builder->whereRaw("{$fields} like ?", ["%{$s}%"]);
        })->orderBy('created_at', 'desc')->paginate();
        $total_blog = $feeds->total();
        return view('layouts.feeds.list', compact('feeds', 's', 'total_blog'));
    }

    public function blogs(Request $request)
    {
        $s = $request->input('s');
        $blogs = Blog::query()->when($s, function (Builder $builder, $s) {
            $fields = "concat(IFNULL(`name`,''),IFNULL(`email`,''),IFNULL(`link`,''),IFNULL(`message`,''))";
            $builder->whereRaw("{$fields} like ?", ["%{$s}%"]);
        })->where('status', 1)->whereNull('feed_link')->paginate();
        $total_blog = $blogs->total();
        return view('layouts.feeds.blogs', compact('blogs', 's', 'total_blog'));
    }
}
