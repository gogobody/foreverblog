<?php

namespace App\Http\Controllers;

use App\Blog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $blog = $request->blog;
        return view('layouts.profile.index', compact('blog'));
    }

    /**
     * 博客设置
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blogChange(Request $request)
    {
        exit;
        /** @var Blog $blog */
        $blog = $request->blog;
        switch ($request->field) {
            case 'is_comment':
                if (!in_array($request->value, [1, 0])) {
                    return $this->error('数据异常');
                }
                break;
        }
        $field = $request->field;
        $blog->$field = trim($request->value);
        $blog->save();
        return $this->success('设置成功');
    }

    /**
     * 提交大事记
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitDateline(Request $request)
    {
        /** @var Blog $blog */
        $blog = $request->blog;
        if ($blog->datelines()->where('status', 0)->count()) {
            return $this->error('您的博客存在正在审核的大事记，请等待该审核处理后继续提交。');
        }
        $content = $request->input('content');
        if (!$time = strtotime($request->date)) {
            return $this->error('时间格式不正确');
        }
        if ($time > time()) {
            return $this->error('不能大于当前时间');
        }
        if (!$content) {
            return $this->error('请输入大事记内容');
        }
        if (mb_strlen($content) > 2000) {
            return $this->error('内容字符过长');
        }
        $blog->datelines()->create([
            'date' => date('Y-m-d H:i:s', $time),
            'content' => $content,
            'status' => 0,
        ]);
        return $this->success('提交成功，审核通过后将会展示在博客详情页。');
    }

    public function checkFeedLink(Request $request)
    {
        try {
            $client = new Client([
                'timeout' => 30,
                'verify' => false,
                'allow_redirects' => false,
            ]);
            $response = $client->get($request->link);
            if ($response->getStatusCode() !== 200) {
                throw new \Exception('无法访问');
            }
        } catch (\Throwable $e) {
            return $this->error('访问地址出错');
        }

        return $this->success();
    }

    /**
     * 提交 feed 地址
     */
    public function submitFeedLink(Request $request)
    {
        $blog = $request->blog;
        $feed_link = $request->input('feed_link');
        if(!$feed_link) $this->error('没有 feed link');
        $postData = [
            'feed_link' => $feed_link
        ];
        $validator = Validator::make($postData, [
            'feed_link' => 'required|url|max:80',
        ], [
            'feed_link.required' => 'feed 地址不能为空',
            'feed_link.url' => 'feed 地址格式不正确',
        ]);
        if ($validator->fails()) {
            return ['code' => 0, 'message' => $validator->errors()->first()];
        }
        $postData = $validator->validated();
        $blog->feed_link = $postData['feed_link'];
        $blog->feed_status = 3;
        $blog->save();
        return $this->success('修改成功。');

    }
    /**
     * 发送登录验证码
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendCodeMail(Request $request)
    {
        if (!$request->email) {
            return $this->error('请输入邮箱');
        }
        if (!Blog::query()
            ->where('email', $request->email)
            ->where('status', 1)
            ->count()
        ) {
            return $this->error('邮箱不存在');
        }
        $code = strtoupper(Str::random(6));
        $cacheKey = $this->getCacheKey($request->email);
        Cache::put($cacheKey, $code, 120);
        Mail::send('emails.code', [
            'content' => "您本次登录的验证码是 <b>{$code}</b>, 有效期 2 分钟，请不要泄漏给其他人，如果不是您本人操作请忽略。",
        ], function ($mail) use ($request) {
            $mail->to($request->email);
            $mail->subject("登录验证码");
        });
        return $this->success('验证码发送成功');
    }

    public function login(Request $request)
    {
        if ($request->method() === 'POST') {
            $cacheKey = $this->getCacheKey($request->email);
            if (!$code = Cache::get($cacheKey)) {
                return $this->error('登录失败');
            }
            if ($code !== $request->code) {
                return $this->error('验证码不正确');
            }
            $request->session()->put('email', $request->email);
            return $this->success('登录成功');
        }
        return view('layouts.profile.login');
    }

    private function getCacheKey($email)
    {
        return md5("email_login_code_{$email}");
    }
}
