@extends('layouts.app')

@section('title', '登录到个人中心 | 十年之约')

@section('content')
<!-- Main -->
<article id="main">

    <div id="profile-login-box">
        <!-- One -->
        <section class="container">

            <!-- Content -->
            <div class="content detail">
                <div id="login-form">
                    <input type="email" name="email" placeholder="请输入邮箱">
                    <input type="text" name="code" placeholder="请输入验证码" style="display: none">
                    <a href="javascript:void(0);" id="get-code" class="button">获取验证码</a>
                    <a href="javascript:void(0);" id="login-submit" class="button" style="display: none">登录</a>
                </div>
            </div>

        </section>
    </div>

</article>
@endsection

@section('js')
<script>
    var loading = false;
    $('#get-code').click(function () {
        if (loading) return;
        $(this).text('请稍等...')
        var self = this;
        $.ajax({
            url: "{{ url('/profile/send_code') }}",
            type: "post",
            data: {
                email: $('[name=email]').val(),
                _token: $('[name="csrf-token"]').attr('content'),
            },
            dataType: "json",
            success: function (response) {
                if (response.code) {
                    $('[name=email]').attr('disabled', true)
                    $('#get-code').hide();
                    $('[name=code]').show();
                    $('#login-submit').show();
                } else {
                    alert(response.message)
                }
            },
            error: function (error) {
                alert('服务异常, 请稍后重试')
            },
            complete: function () {
                loading = false;
                $(self).text('获取验证码')
            }
        });
    });
    $('#login-submit').click(function () {
        if (loading) return;
        $(this).text('请稍等...')
        var self = this;
        $.ajax({
            url: "",
            type: "post",
            data: {
                email: $('[name=email]').val(),
                value: $('[name=code]').val(),
                _token: $('[name="csrf-token"]').attr('content'),
            },
            dataType: "json",
            success: function (response) {
                if (response.code) {
                    window.location.href = '/profile.html'
                } else {
                    alert(response.message)
                }
            },
            error: function (error) {
                alert('服务异常, 请稍后重试')
            },
            complete: function () {
                loading = false;
                $(self).text('登录')
            }
        });
    });
</script>
@endsection
