@extends('layouts.app')

@section('title', '个人中心 | 十年之约')

@section('content')
<!-- Main -->
<article id="main">

    <div id="profile-box">
        <!-- One -->
        <div class="container">
            <ol id="tabs">
                <li class="active" data-tab="info">个人资料</li>
                <li data-tab="dateline">更新大事记</li>
            </ol>
            <!-- Content -->
            <div id="content">
                <div id="tab-info">
                    <table>
                        <tbody>
                        <tr>
                            <td>博客名称</td>
                            <td>{{ $blog->name }}</td>
                        </tr>
                        <tr>
                            <td>博客主页</td>
                            <td><a href="{{ $blog->detail_url }}" target="_blank">{{ $blog->detail_url }}</a></td>
                        </tr>
                        <tr>
                            <td>博客地址</td>
                            <td><a href="{{ $blog->link }}" target="_blank">{{ $blog->link }}</a></td>
                        </tr>
                        <tr>
                            <td>寄语</td>
                            <td>{{ $blog->message }}</td>
                        </tr>
                        <tr>
                            <td>URL Slug</td>
                            <td>{!! $blog->slug ? url('/blog', '', true) . "/<b>{$blog->slug}</b>.html" : '-' !!}</td>
                        </tr>
                        <tr>
                            <td>浏览量</td>
                            <td>{{ $blog->views }}</td>
                        </tr>
                        <tr>
                            <td>是否允许评论</td>
                            <td>
                                <input class="switch" name="is_comment" type="checkbox" {{ $blog->is_comment ? 'checked' : ''  }}/>
                            </td>
                        </tr>
                        <tr>
                            <td>异常次数</td>
                            <td>{{ $blog->abnormal_num }}</td>
                        </tr>
                        <tr>
                            <td>上次异常时间</td>
                            <td>{{ $blog->abnormal_at ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td>加入时间</td>
                            <td>{{ $blog->created_at ?: '-' }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="tab-dateline">
                    <input type="datetime-local" name="date" placeholder="请输入日期">
                    <textarea name="content" placeholder="请输入大事记内容，支持 markdown 语法" rows="3" style="resize: vertical; margin-top: 0px; margin-bottom: 0px; height: 134px;"></textarea>
                    <a href="javascript:void(0);" id="dateline-submit" class="button">提交大事记</a>
                </div>
            </div>
        </div>
    </div>

</article>
@endsection

@section('js')
<script>
    var loading = false;
    $('#tab-info').show();
    $('#tabs li').click(function () {
        $(this).addClass('active').siblings('li').removeClass('active');
        $('#content>div').hide();
        $('#tab-' + $(this).data('tab')).show();
    });
    $('#dateline-submit').click(function () {
        if (loading) return;
        $(this).text('请稍等...')
        var self = this;
        $.ajax({
            url: "{{ url('/profile/dateline/submit') }}",
            type: "post",
            data: {
                date: $('[name=date]').val(),
                content: $('[name=content]').val(),
                _token: $('[name="csrf-token"]').attr('content'),
            },
            dataType: "json",
            success: function (response) {
                alert(response.message)
                if (response.code) {
                    $('[name=date]').val('')
                    $('[name=content]').val('')
                }
            },
            error: function (error) {
                alert('服务异常, 请稍后重试')
            },
            complete: function () {
                loading = false;
                $(self).text('提交大事记')
            }
        });
    });
    $('[name=is_comment]').change(function () {
        if (loading) return;
        $.ajax({
            url: "{{ url('/profile/blog/change') }}",
            type: "post",
            data: {
                field: 'is_comment',
                value: this.checked ? 1 : 0,
                _token: $('[name="csrf-token"]').attr('content'),
            },
            dataType: "json",
            success: function (response) {
                alert(response.message)
            },
            error: function (error) {
                alert('服务异常, 请稍后重试')
            },
            complete: function () {
                loading = false;
            }
        });
    })
</script>
@endsection
