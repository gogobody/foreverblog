@extends('layouts.feed')

@section('content')
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

                                    <h1 class="post-title" style="margin-left: 50px">
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

    </main>
@endsection
