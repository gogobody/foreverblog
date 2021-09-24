@extends('layouts.feed')

@section('content')
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

                                    <h1 class="post-title" style="margin-left: 50px">
                                        <a class="post-title-link" target="_blank" href="{{ $item->link }}" itemprop="url">
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
    </main>
@endsection
