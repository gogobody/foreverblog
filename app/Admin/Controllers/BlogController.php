<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Blog\Send;
use App\Admin\Extensions\BlogsExporter;
use App\Blog;
use App\Config;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;
use App\Admin\Actions\Blog\Record;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;

class BlogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '博客管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Blog);
        $grid->exporter(new BlogsExporter)->disableExport(false);

        $grid->quickSearch('name', 'email', 'link', 'slug', 'message');

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->like('name', __('博客名称'));
                $filter->like('email', __('邮箱'));
            });
            $filter->column(1 / 2, function ($filter) {
                $filter->like('link', __('链接'));
                $filter->like('message', __('寄语'));
            });
        });

        $grid->column('id', 'ID')->sortable()->modal('大事记', function ($model) {
            $datelines = $model->datelines()->orderBy('created_at', 'desc')->get()->map(function ($dateline) {
                return $dateline->only(['id', 'date', 'content']);
            });
            return new Table(['ID', __('记录时间'), __('内容')], $datelines->toArray());
        });
        $grid->column('name', __('博客名称'))->editable();
        $grid->column('avatar', __('头像'))->display(function ($avatar) {
            return '<img style="border-radius: 50%" width="20" src="' . $avatar . '">';
        });
        $grid->column('email', __('邮箱'));
        $grid->column('link', __('链接地址'))->link()->copyable();
        $grid->column('feed_link', __('订阅地址'))->editable()->copyable();
        $grid->column('feed_status', __('订阅状态'))->filter(Blog::FEED_STATUS)->editable('select', Blog::FEED_STATUS);
        $grid->column('slug', __('Slug'))->editable();
        $grid->column('message', __('寄语'))->limit(40);
        $grid->column('views', __('阅读量'))->sortable();
        $grid->column('status', __('状态'))->filter(Blog::STATUS)->editable('select', Blog::STATUS);
        $grid->column('is_notify', __('邮件通知'))->bool();
        $grid->column('created_at', __('提交时间'))->sortable()
            ->filter('range', 'datetime');

        $grid->actions(function ($actions) {
            $actions->add(new Record);
            $actions->add(new Send);
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Blog::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('博客名称'));
        $show->field('link', __('网址'))->link();
        $show->field('feed_link', __('feed地址'))->link();
        $show->field('feed_status', __('feed状态'))
            ->using([0 => '未填写', 1 => '正常', 2 => '抓取异常'])->label();
        $show->field('email', __('邮箱'));
        $show->field('message', __('寄语'));
        $show->field('status', __('状态'))
            ->using([0 => '审核中', 1 => '正常', 2 => '未通过', 3 => '疑似异常', 4 => '异常'])->label();
        $show->field('is_comment', __('是否允许评论'))->using([0 => '否', 1 => '是'])->label();
        $show->field('history', __('历史事件'));
        $show->field('views', __('浏览量'));
        $show->field('slug', 'Slug');
        $show->field('is_notify', __('邮件通知'))->using([0 => '未通知', 1 => '已通知'])->label();
        $show->field('abnormal_num', __('异常次数'));
        $show->field('abnormal_at', __('上次异常时间'));
        $show->field('updated_at', __('更新时间'));
        $show->field('created_at', __('创建时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Blog);

        $form->display('id', 'ID');
        $form->text('name', __('博客名称'))->rules('required|min:2');
        $form->email('email', __('邮箱'))
            ->rules('required|email')
            ->creationRules(['required', "unique:blog"])
            ->updateRules(['required']);
        $form->url('link', __('链接地址'))->rules('required|url');
        $form->url('feed_link', __('feed地址'))->rules('url');
        $form->radio('feed_status', __('feed状态'))->options(Blog::FEED_STATUS)->default(0);
        $form->text('slug', __('Slug'))
            ->creationRules([
                'nullable',
                'unique:blog',
                'alpha_dash',
                'not_regex:/^\d+$/i',
                'max:200'
            ], [
                'not_regex' => 'Slug 不能为纯数字'
            ])
            ->updateRules([
                'nullable',
                'unique:blog,slug,{{id}}',
                'alpha_dash',
                'not_regex:/^\d+$/i',
                'max:200'
            ], [
                'not_regex' => 'Slug 不能为纯数字'
            ]);
        $form->textarea('message', __('博主寄语'))->rules('required|max:200');
        $form->radio('status', __('状态'))->options(Blog::STATUS)->default(0);
        $form->text('views', __('阅读量'))->rules('numeric');

        return $form;
    }

    public function check(Content $content, Request $request)
    {
        $start = $request->input('start');
        // TODO 检测手动检测任务是否正在进行
        if ($start) {
            header('X-Accel-Buffering: no');
            $html = <<<'EOF'
<head>
<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
</head>
<style>
  p {
    font-size: 15px;
    margin: 0 0 5px;
  }
  .success {
    color: green !important;
  }
  .error {
    color: red !important;
  }
</style>
<script>
  var toBottom = setInterval(function() {
    // 滚动到底部
    $('body').animate({scrollTop: $('body').prop("scrollHeight")}, 1000);
  }, 3000);
  var timer = setInterval(function() {
    // 检测数量
    window.parent.$('#normal-num').text($('span.success').length);
    // 遍历异常博客
    var $errors = window.parent.$('#errors');
    $('span.error, span.end').each(function(index, item) {
        var $p = $(item).closest('p');
        if ($(item).hasClass('end')) {
            window.parent.$('#start').html('点击开始检测').attr('disabled', false);
            clearInterval(toBottom);
            alert('检测完成');
            return clearInterval(timer);
        }
        var id = $p.attr('id');
        var name = $p.data('name');
        var link = $p.data('link');
        if ($errors.find('p#' + id).length <= 0) {
            $errors.append('<p id="' + id + '">[' + name + '][<a target="_blank" href="' + link + '">' + link + '</a>]</p>');
            window.parent.$('#abnormal-num').text($('span.error').length);
        }
    });
  }, 1000);
</script>
EOF;
            echo $html;
            $content = ob_get_contents();
            set_time_limit(0);
            ignore_user_abort(0);
            if (ob_get_length()) ob_end_clean();
            ob_implicit_flush();

            echo $content;
            $this->checkBlogOut();

            die;
        }

        return $content
            ->title('手动检测')
            ->description('手动检测博客状态')
            ->row(view('admin.check'));
    }

    private function checkBlogOut()
    {
        $configs = Config::all()->whereIn('key', [
            'auto_detection',
            'auto_writing_dateline',
            'auto_writing_period',
            'max_abnormal_num'
        ]);
        $options = [];
        foreach ($configs as $config) {
            $options[$config->key] = $config->value;
        }
        $client = new Client([
            'timeout' => 30,
            'verify' => false,
            'allow_redirects' => false,
        ]);

        DB::beginTransaction();
        $error = function ($id) {
            $this->out("<span class='error'>×</span></p>");
            // 手动检测直接列入疑似异常列表
            $data = ['status' => 3, 'abnormal_num' => 1, 'abnormal_at' => time()];
            if (!Blog::where('id', $id)->update($data)) {
                DB::rollBack();
            }
        };
        Blog::where('status', 1)->chunk(10, function ($blogs) use (&$client, &$options, &$error) {
            foreach ($blogs as $blog) {
                try {
                    $promise = $client->getAsync($blog->link, [
                        'headers' => [
                            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.122 Safari/537.36',
                        ]
                    ])->then(
                        function (ResponseInterface $res) {
                            $this->out("<span class='success'>√</span></p>");
                        },
                        function (RequestException $e) use ($blog, $options) {
                            throw new \Exception($e->getMessage());
                        }
                    );
                    $this->out("<p class='blog' data-name='{$blog->name}' data-link='{$blog->link}' id='{$blog->id}'>检测博客 [{$blog->name}][<a target='_blank' href='{$blog->link}'>{$blog->link}</a>] ...");

                    $promise->wait();
                } catch (\Exception $e) {
                    $error($blog->id);
                } catch (\Throwable $e) {
                    $error($blog->id);
                }
            }
        });

        DB::commit();
        $this->out('<p><span class="end">end</span></p>');
    }

    private function out(...$args)
    {
        foreach ($args as $arg) {
            echo $arg;
        }
    }
}
