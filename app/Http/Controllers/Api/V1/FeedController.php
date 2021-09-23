<?php

namespace App\Http\Controllers\Api\V1;

use App\Feed;
use App\Http\Controllers\Controller;
use App\Http\Resources\Feeds;
use App\Http\Resources\FeedsCollection;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * 分页获取 RSS
     */
    public function queryRss(Request $request)
    {
        $querySecret = env('QUERY_SECRET');
        if (!$querySecret) {
            return $this->error('未配置 QUERY_SECRET ');
        }
        $qsec = $request->input('secret');
        if ($qsec != $querySecret) {
            return $this->error('secret 错误');
        }
        $feeds = Feed::query()->orderBy('created_at','desc')->paginate();
        return $this->result(new FeedsCollection($feeds));
    }
}
