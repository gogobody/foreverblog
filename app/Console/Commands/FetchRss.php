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
        $s = $f = 0;
        Blog::query()
            ->where('status', 1)
            ->with('feeds')
            ->whereNotNull('feed_link')
            ->chunk(10, function ($blogs) use (&$s, &$f) {
                /** @var Blog $blog */
                foreach ($blogs as $blog) {
                    try {
                        $feed = new SimplePie();
                        $feed->set_cache_location(storage_path('app/cache'));
                        $feed->set_feed_url($blog->feed_link);
                        $feed->set_useragent($this::$useragent);
                        $feed->init();
                        $feed->enable_cache(true);
                        $feed->set_cache_duration(300);
                        $feed->handle_content_type();
                        if (!$feed->error) {
                            foreach ($feed->get_items(0, 8) as $item) {
                                $author = $item->get_author();
                                Feed::query()->updateOrInsert([
                                    'blog_id' => $blog->id,
                                    'link' => $item->get_permalink(),
                                ], [
                                    'title' => $item->get_title(),
                                    'author' => $author ? ($author->get_name() ?: '匿名') : '未知',
                                    'desc' => $item->get_description(),
                                    'created_at' => $item->get_date('Y-m-d H:i:s'),
                                    'updated_at' => $item->get_updated_date('Y-m-d H:i:s'),
                                ]);
                            }
                            $blog->feed_status = 1;
                        } else {
                            $blog->feed_status = 2;
                        }
                        $blog->save();
                    } catch (\Throwable $e) {
                        $f++;
                        // 忽略单个订阅地址发生的错误
                        continue;
                    }
                    $s++;
                }
            });
        $this->info("订阅更新完毕，共成功 {$s} 条，失败 {$f} 条");
    }
}
