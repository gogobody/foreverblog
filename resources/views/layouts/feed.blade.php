<!doctype html>

<head lang="zh" class="theme-next use-motion theme-next-mist">
    <head>
        <meta charset="UTF-8">
        <title>十年之约——专题展示 | 一个人的寂寞，一群人的狂欢。</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content="@yield('description', '十年之约是一个记录、展示独立博客的平台，即从加入这个活动起，我们的博客10年不关闭或者更久，保持更新和活力。把博客从爱好变成一种习惯，坚持10年，是一项很有意义的活动，我们希望更多的博主加入！')" />
        <meta name="keywords" content="十年之约,个人博客,博客十年之约,博客收录,博客交流,博客展示,独立博客,记录我们的十年,RSS订阅,十年之约RSS订阅" />
        <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
        <link rel='stylesheet' href='/assets/css/feed.css?ver=1.0' type='text/css' media='all'/>
        <script class="class" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <script type="text/javascript"> var CONFIG = {motion: true, sidebar: 'post'};</script>
    </head>
<body>
<div class="container one-column page-home">
    <!--page home-->
    <div class="headband"></div>
    <header id="header" class="header">
        <div class="header-inner">
            <h1 class="site-meta">
                <span class="logo-line-before"><i></i></span>
                <a href="{{ url('/feeds.html') }}" class="brand" rel="start">
              <span class="logo">
                <i class="icon-next-logo"></i>
            </span>
                    <span class="site-title">十年之约——专题展示</span>
                </a>
                <span class="logo-line-after"><i></i></span></h1>
            <div class="site-nav-toggle">
                <button>
                    <span class="btn-bar"></span>
                    <span class="btn-bar"></span>
                    <span class="btn-bar"></span>
                </button>
            </div>
            <nav class="site-nav">
                <false id="menu" class="menu menu-left">
                    <ul>
                        <li class="page_item page-item-2"><a href="{{ url('feeds/no-rss-list.html') }}">NO RSS</a>
                        </li>
                    </ul>
                </false>
                <div class="site-search">
                    <form class="site-search-form">
                        <input type="text" id="st-search-input" name="s" class="st-search-input st-default-search-input"
                               autocomplete="off" autocorrect="off" autocapitalize="off" value="{{ $s }}"/>
                    </form>
                </div>
            </nav>
        </div>
    </header>

    @yield('content')

    <footer id="footer" class="footer">
        <div class="footer-inner">


            <div class="copyright">

                    <span class="author" itemprop="copyrightHolder">
                        <a href="{{ url('/') }}">十年之约</a>
                    </span>
                &nbsp;&copy;&nbsp;版权所有


            </div>
        </div>
    </footer>
    <div class="back-to-top"></div>
</div>
<script crossorigin="anonymous" integrity="sha384-7j+H85qDApQPyKm8wg64JdGgKmzM7trE+amLzYcJLfwR7rixgAeIi1kSX2VHeje4" src="//lib.baomitu.com/velocity/1.2.2/velocity.min.js"></script>
<script crossorigin="anonymous" integrity="sha384-ygLIhCkN7QklBUtiFBKpkFIa6x1D0+EM32PXnPzrqv1cNI8h2AqvQgYrMfIBVv6v" src="//lib.baomitu.com/velocity/1.2.2/velocity.ui.min.js"></script>
<script type="text/javascript" src="/assets/js/feed.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?0c7836ac8678d921d1d4ad74e6affa81";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);

        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        } else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        s.parentNode.insertBefore(bp, s);
    })();
</script>
</body>

</html>
