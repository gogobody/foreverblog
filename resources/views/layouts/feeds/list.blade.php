<!doctype html>

<head lang="zh" class="theme-next use-motion theme-next-mist">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
        <script class="class" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <script type="text/javascript"> var CONFIG = {motion: true, sidebar: 'post'};</script>
        <title>十年之约——专题展示 | 一个人的寂寞，一群人的狂欢。</title>

        <link rel='stylesheet' href='/assets/css/feed.css' type='text/css' media='all'/>


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
    <main id="main" class="main">
        <div class="main-inner">
            <div id="content" class="content">
                <section id="posts" class="posts-collapse">
                    @if(!empty($s))
                        <span class="archive-move-on"></span>
                        <span class="archive-page-counter" style="position: relative;">“{{ $s }}” 的搜索结果</span>
                    @endif
                    @if(count($feeds))
                        @foreach($feeds as $item)
                            <article class="post post-type-normal">
                                <header class="post-header">
                                    <div class="post-author">
                                        {{ $item->author }}
                                    </div>

                                    <h1 class="post-title">
                                        <a class="post-title-link" href="{{ $item->link }}" itemprop="url">
                                            <span itemprop="name">{{ $item->title }}</span>
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
{{--                    @if($show_pages)--}}
{{--                        @foreach($show_pages as $page)--}}
{{--                    <a href='{{ $page['url'] }}' class='current'>{{ $page['page'] }}</a>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                    <a href="{{ $next_page }}">></a>--}}
                    @if ($feeds->hasPages())
                                {{-- Previous Page Link and page 1 --}}
                                @if ($feeds->onFirstPage())
                                    <span class="page-item disabled" tabindex="-1"><span class="page-link">&laquo;</span></span>
                                    <span class="page-item active"><span class="page-link">1</span></span>
                                @else
                                    <span class="page-item"><a class="page-link" href="{{ $feeds->previousPageUrl() }}" rel="prev">&laquo;</a></span>
                                    <span class="page-item"><a class="page-link" href="{{ $feeds->url(1) }}">1</a></span>
                                @endif

                                @php
                                    $halfTotal      = intval($feeds->lastPage() / 2);
                                    $limit          = 3;
                                    $halfLimit      = intval($limit / 2);
                                    $pageRightBound = $feeds->currentPage() + $halfLimit;
                                    $pageLeftBound  = $feeds->currentPage() - $halfLimit;

                                @endphp

                                @if ($feeds->lastPage() <= $limit)
                                    @for ($page = 2; $page <= $feeds->lastPage(); $page++)
                                        @if ($page == $feeds->currentPage())
                                            <span class="page-item active"><span class="page-link">{{ $page }}</span></span>
                                        @else
                                            <span class="page-item"><a class="page-link" href="{{ $feeds->url($page) }}">{{ $page }}</a></span>
                                        @endif
                                    @endfor
                                @else
                                    {{-- When there are less than $halfLimit pages to show on left or right of the current page  --}}
                                    @php
                                        if ($pageRightBound >= $feeds->lastPage() - 1) {
                                            $pageLeftBound = $feeds->lastPage() - $limit;
                                            $pageRightBound = $feeds->lastPage() - 1;
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
                                        @if ($page == $feeds->currentPage())
                                            <span class="page-item active"><span class="page-link">{{ $page }}</span></span>
                                        @else
                                            <span class="page-item"><a class="page-link" href="{{ $feeds->url($page) }}">{{ $page }}</a></span>
                                        @endif
                                    @endfor

                                    {{-- Show three dot separator on the right --}}
                                    @if ($pageRightBound < $feeds->lastPage() - 1)
                                                    <span class="page-item disabled" tabindex="-1"><span class="page-link">...</span></span>
                                    @endif

                                    {{-- Display the last page --}}
                                    @if ($feeds->currentPage() == $feeds->lastPage())
                                                    <span class="page-item active"><span class="page-link">{{ $feeds->lastPage() }}</span></span>
                                    @else
                                        <span class="page-item"><a class="page-link" href="{{ $feeds->url($feeds->lastPage()) }}">{{ $feeds->lastPage() }}</a></span>
                                    @endif
                                @endif


                                {{-- Pagination Elements --}}

                                {{-- Next Page Link --}}
                                @if ($feeds->hasMorePages())
                                    <span class="page-item"><a class="page-link" href="{{ $feeds->nextPageUrl() }}" rel="next">&raquo;</a></span>
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
