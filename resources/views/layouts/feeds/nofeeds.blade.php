<!doctype html>

<head lang="zh" class="theme-next use-motion theme-next-mist">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
        <link rel='stylesheet' href='/assets/css/feed.css' type='text/css' media='all'/>
        <script class="class" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <script type="text/javascript"> var CONFIG = {motion: true, sidebar: 'post'};</script>
        <title>十年之约——专题展示 | 一个人的寂寞，一群人的狂欢。</title>
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
                        <li class="page_item page-item-2"><a href="{{ url('no-rss-list.html') }}">NO RSS</a>
                        </li>
                    </ul>
                </false>
                <div class="site-search">
                    <form class="site-search-form">
                        <input type="text" id="st-search-input" name="s" class="st-search-input st-default-search-input"
                               autocomplete="off" autocorrect="off" autocapitalize="off" value=""/>
                    </form>
                </div>
            </nav>
        </div>
    </header>
    <main id="main" class="main">
        <div class="main-inner">
            <div id="content" class="content">
                <article class="post post-type-normal " itemscope="" itemtype="http://schema.org/Article">
                    <header class="post-header">
                        <h1 class="post-title" itemprop="name headline">NO RSS</h1>
                    </header>
                    <div class="post-body">
                        <span itemprop="articleBody">
                            <p>这边是没有订阅功能的博客列表！</p>
                        </span>
                    </div>
                    <footer class="post-footer">
                        <div class="post-tags"></div>
                    </footer>
                </article>

                <section id="posts" class="posts-collapse">
                    @if(!empty($s))
                        <span class="archive-move-on"></span>
                        <span class="archive-page-counter" style="position: relative;">“{{ $s }}” 的搜索结果</span>
                    @endif
                    @if(count($blogs))
                        @foreach($blogs as $item)
                            <article class="post post-type-normal">
                                <header class="post-header">
                                    <div class="post-author">
                                    </div>

                                    <h1 class="post-title">
                                        <a class="post-title-link" href="{{ $item->link }}" itemprop="url">
                                            <span itemprop="name">{{ $item->name }}</span>
                                        </a>

                                    </h1>

                                    <div class="post-meta">
                                        <time class="post-time" itemprop="dateCreated">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('m-d') }}
                                        </time>
                                    </div>

                                </header>
                            </article>
                        @endforeach
                    @endif
                </section>
                <nav class="pagination">

                    @if ($blogs->hasPages())
                        {{-- Previous Page Link and page 1 --}}
                        @if ($blogs->onFirstPage())
                            <span class="page-item disabled" tabindex="-1"><span class="page-link">&laquo;</span></span>
                            <span class="page-item active"><span class="page-link">1</span></span>
                        @else
                            <span class="page-item"><a class="page-link" href="{{ $blogs->previousPageUrl() }}"
                                                       rel="prev">&laquo;</a></span>
                            <span class="page-item"><a class="page-link" href="{{ $blogs->url(1) }}">1</a></span>
                        @endif

                        @php
                            $halfTotal      = intval($blogs->lastPage() / 2);
                            $limit          = 6;
                            $halfLimit      = intval($limit / 2);
                            $pageRightBound = $blogs->currentPage() + $halfLimit;
                            $pageLeftBound  = $blogs->currentPage() - $halfLimit;

                        @endphp

                        @if ($blogs->lastPage() <= $limit)
                            @for ($page = 2; $page <= $blogs->lastPage(); $page++)
                                @if ($page == $blogs->currentPage())
                                    <span class="page-item active"><span class="page-link">{{ $page }}</span></span>
                                @else
                                    <span class="page-item"><a class="page-link"
                                                               href="{{ $blogs->url($page) }}">{{ $page }}</a></span>
                                @endif
                            @endfor
                        @else
                            {{-- When there are less than $halfLimit pages to show on left or right of the current page  --}}
                            @php
                                if ($pageRightBound >= $blogs->lastPage() - 1) {
                                    $pageLeftBound = $blogs->lastPage() - $limit;
                                    $pageRightBound = $blogs->lastPage() - 1;
                                }
                                if ($pageLeftBound <= 2) {
                                    $pageRightBound = 1 + $limit;
                                    $pageLeftBound = 2;
                                }
                            @endphp

                            {{-- Show three dot separator on the left --}}
                            @if ($pageLeftBound > 2)
                                <span class="page-item disabled" tabindex="-1"><span class="page-link">...</span></span>
                            @endif

                            @for ($page = $pageLeftBound; $page <= $pageRightBound; $page++)
                                @if ($page == $blogs->currentPage())
                                    <span class="page-item active"><span class="page-link">{{ $page }}</span></span>
                                @else
                                    <span class="page-item"><a class="page-link"
                                                               href="{{ $blogs->url($page) }}">{{ $page }}</a></span>
                                @endif
                            @endfor

                            {{-- Show three dot separator on the right --}}
                            @if ($pageRightBound < $blogs->lastPage() - 1)
                                <span class="page-item disabled" tabindex="-1"><span class="page-link">...</span></span>
                            @endif

                            {{-- Display the last page --}}
                            @if ($blogs->currentPage() == $blogs->lastPage())
                                <span class="page-item active"><span
                                        class="page-link">{{ $blogs->lastPage() }}</span></span>
                            @else
                                <span class="page-item"><a class="page-link"
                                                           href="{{ $blogs->url($blogs->lastPage()) }}">{{ $blogs->lastPage() }}</a></span>
                            @endif
                        @endif


                        {{-- Pagination Elements --}}

                        {{-- Next Page Link --}}
                        @if ($blogs->hasMorePages())
                            <span class="page-item"><a class="page-link" href="{{ $blogs->nextPageUrl() }}" rel="next">&raquo;</a></span>
                        @else
                            <span class="page-item disabled" tabindex="-1"><span class="page-link">&raquo;</span></span>
                        @endif
                    @endif
                </nav>

            </div>
        </div>

        <div class="sidebar-toggle">
            <div class="sidebar-toggle-line-wrap">
                <span class="sidebar-toggle-line sidebar-toggle-line-first"></span>
                <span class="sidebar-toggle-line sidebar-toggle-line-middle"></span>
                <span class="sidebar-toggle-line sidebar-toggle-line-last"></span>
            </div>
        </div>
        <aside id="sidebar" class="sidebar">
            <div class="sidebar-inner">

                <section class="site-overview sidebar-panel sidebar-panel-active">
                    <div class="site-author motion-element">


                        <img class="site-author-image"
                             src="https://cdn.v2ex.com/gravatar/5385dd848582c2a9f3881a21ba543dd6?s=160&d=mm&r=g"
                             alt="WEX"/>
                        <p class="site-author-name"></p>
                    </div>

                    <p class="site-description motion-element" itemprop="description">
                        不积跬步无以至千里 </p>
                    <nav class="site-state motion-element">
                        <div class="site-state-item site-state-posts">
                                <span class="site-state-item-count">
                                    {{ $total_blog }}                                </span>
                            <span class="site-state-item-name">博客总数</span>
                        </div>
                    </nav>


                </section>
                <section class="post-toc-wrap  ">
                    <div class="post-toc-indicator-top post-toc-indicator"></div>
                    <div class="post-toc">
                        <p class="post-toc-empty">
                        </p>
                    </div>
                </section>
            </div>
        </aside>


    </main>
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

</body>

</html>
