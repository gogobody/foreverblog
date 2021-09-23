<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Feed;
use App\Http\Resources\Feeds;
use App\Http\Resources\FeedsCollection;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    //
    public function feeds(Request $request)
    {
        $s = $request->input('s');
        if(!empty($s)){
            $feeds = Feed::query()->where('title','like','%'.$s.'%')->orderBy('created_at', 'desc')->paginate();
        }else{
            $feeds = Feed::query()->orderBy('created_at', 'desc')->paginate();
        }

        return view('layouts.feeds.list', compact('feeds','s'));
    }

    public function nofeeds(Request $request)
    {
        $s = $request->input('s');
        if(!empty($s)){
            $blogs = Blog::query()->where('status', 1)
                ->where('name','like','%'.$s.'%')->whereNull('feed_link')->paginate();
        }else{
            $blogs = Blog::query()->where('status', 1)->whereNull('feed_link')->paginate();
        }
        return view('layouts.feeds.nofeeds', compact('blogs','s'));
    }
}
