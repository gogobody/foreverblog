<!DOCTYPE HTML>
<html>
<head>
    <title>十年之约博客提交</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="十年之约,个人博客,博客十年之约,博客收录,博客交流,博客展示,十年之约,十年之约签约博客申请">
    <meta name="description" content="记录我们的十年">
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico"/>
    <link href="/assets/css/join.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>
<a href="{{ url('/') }}"><h1>十年之约</h1></a>
<div class="contact">
    <h2>Join Us</h2>
    <p>十年之约到底是什么？ 访问了解： <a href="{{ url('/about.html') }}" target="_blank" title="十年之约">点击这里</a></p>
    <form action="{{ url('/join.html') }}" method="post">
        @csrf
        <h3>博客名称 <span>*</span></h3>
        <input type="text" class="user active" required="" name="name" autocomplete="off" placeholder="请输入博客名称">
        <h3>邮箱 <span>*</span></h3>
        <input type="text" class="email" required="" name="email" autocomplete="off" placeholder="请输入邮箱，头像将使用基于邮箱生成的 Gravatar 头像">
        <h3>网站地址 <span>*</span></h3>
        <input type="text" class="url" required="" name="link" autocomplete="off" placeholder="请输入博客链接">
        <h3>feed地址</h3>
        <input type="text" class="url" name="feed_link" autocomplete="off" placeholder="请输入博客feed链接，非必填">
        <h3>博主寄语 <span>*</span></h3>
        <textarea class="i" name="message" placeholder="博客寄语，将会在博客详情页展示，建议在 80-100 个字符以内" required></textarea>
        <h3>验证码 <span>*</span></h3>
        <img src="{{ captcha_src() }}" id="verify">
        <br>
        <input type="text" required="" name="captcha" autocomplete="off" placeholder="请输入验证码">
        @if($closeApply)
            <input type="submit" value="已关闭申请系统" disabled>
        @else
            <input type="submit" value="确认提交"/>
        @endif
    </form>
</div>
<div class="copyright">
    <p>由<a href="https://github.com/foreverblog" target="_blank" title="十年之约">十年之约</a>提供技术支持</p>
</div>
</body>
</html>
<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
<script type="text/javascript">
    $('#verify').click(function () {
        $(this).attr('src', ("{{ url('/captcha/default') }}" + "?date=" + new Date().getTime()));
    });
</script>
@if(!$closeApply)
<script type="text/javascript">
    $('form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: this.action,
            type: 'post',
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                alert(response.message);
                if (response.code) {
                    window.location.href = "{{ url('/') }}";
                } else {
                    $('#verify').click();
                }
            },
            error: function () {
                alert('申请失败, 请稍后重试');
            }
        });
    });
</script>
@endif
