<!--页面来自开往  https://github.com/volfclub/travellings/blob/master/index.html -->
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--    预加载提高访问速度-->
    <meta http-equiv='x-dns-prefetch-control' content='on'>
    <link rel='dns-prefetch' href="{{ $blog->link }}">
    <link rel="prefetch" href="{{ $blog->link }}"/>
    <link rel="next" href="{{ $blog->link }}">
    <title>虫洞-随机访问十年之约成员博客</title>
    <style>

        * {
            color: #111827;
        }

        body {
            background-color: #ECF0F5;
        }

        a {
            text-decoration: none;
        }

        .blink {
            position: fixed;
            height: 100%;
            width: 100%;
            text-align: center;
            display: flex;
            display: -webkit-flex;
            align-items: center;
            justify-content: center;
            animation: blink 3s linear infinite;
            -webkit-animation: blink 3s linear infinite;
            -moz-animation: blink 3s linear infinite;
            -ms-animation: blink 3s linear infinite;
            -o-animation: blink 3s linear infinite;
        }

        @keyframes blink {
            0% {
                transform: scale(1);
            }

            20% {
                transform: scale(1);
            }

            40% {
                transform: scale(1);
            }

            80% {
                transform: scale(0.98);
            }

            90% {
                transform: scale(0.98);
            }

            100% {
                transform: scale(1.2);
            }
        }

        .botCenter {
            position: fixed;
            width: 100%;
            height: 50px;
            bottom: 20px;
            line-height: 20px;
            font-size: 12px;
            text-align: center;
            animation: botCenter 3s linear;
            -webkit-animation: botCenter 3s linear;
            -moz-animation: botCenter 3s linear;
            -ms-animation: botCenter 3s linear;
            -o-animation: botCenter 3s linear;
        }

        @keyframes botCenter {
            0% {
                opacity: 0;
            }

            20% {
                opacity: 0;
            }

            40% {
                opacity: 0.3;
            }

            80% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<div class="container">

    <div class="blink">
        <div class="link">
            <p>即将奔赴 <b>{{ $blog->name }}</b> 的十年</p>
            <p>加入时间 {{ $blog->adopted_at->format('Y-m-d') }}</p>
            <p>博主寄语 </p>
            <i>{{ $blog->message }}</i>
        </div>
    </div>


    <div class="botCenter">
        Tips: <b>后退</b>网页即可再次穿梭<b>虫洞</b><br/>
        <a href="https://www.foreverblog.cn/" target="_blank">
            <img src="https://img.foreverblog.cn/logo_en_default.png" alt="" style="width:auto;height:16px;">
        </a>
        <div class="time">2017-
            <script>document.write((new Date()).getFullYear())</script>
        </div>
    </div>

</div>


<script>

    window.setTimeout(function () {
        window.location = "{{ $blog->link }}"
    }, 4000);

    var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?0c7836ac8678d921d1d4ad74e6affa81";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>

</body>
</html>
