<?php

namespace App\Console\Commands;

use App\Blog;
use App\Feed;
use Illuminate\Console\Command;
use App\Http\Resources\Blogs;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use SimplePie;

class FetchRss extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:rss';

    public static $useragent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'dump blog rss to json file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Blog::query()->where('status', 1)->whereNotNull('feed_link')->chunk(10, function ($blogs) {
            foreach ($blogs as $blog) {
                $feed = new SimplePie();
                $feed->set_feed_url($blog->feed_link);
                $feed->set_useragent($this::$useragent);
                $feed->init();
                $feed->enable_cache(true);
                $feed->set_cache_duration(300);
                $feed->handle_content_type();
                if (!$feed->error) {
                    // 清空 blog 关联的所有 feed
                    Blog::find($blog->id)->feeds()->delete();

                    $data = [];
                    // 抓取 5 条 feed
                    foreach ($feed->get_items(0, 5) as $item) {
                        $tmp = [
                            'title' => $item->get_title(),
                            'author' => $item->get_author()->get_name(),
                            'link' => $item->get_permalink(),
                            'desc' => $item->get_description(),
                            'created_at' => $item->get_date('Y-m-d H:i:s'),
                            'updated_at' => $item->get_updated_date('Y-m-d H:i:s'),
                        ];
                        array_push($data, new Feed($tmp));
                    }
                    // 重新插进入 feed
                    if (!Blog::find($blog->id)->feeds()->saveMany($data)) {
                        DB::rollBack();
                    }
                    // 修改博客 feed 状态
                    if (!Blog::find($blog->id)->update(['feed_status' => 1])) {
                        DB::rollBack();
                    }
                } else {
                    echo("fetch rss ".$blog->feed_link." failed: ".$feed->error.PHP_EOL);
                    if (!Blog::find($blog->id)->update(['feed_status' => 2])) {
                        DB::rollBack();
                    }
                }
            }
        });
    }
}