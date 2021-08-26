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
    <link rel='dns-prefetch' href="{{ $blog['link'] }}">
    <link rel="prefetch" href="{{ $blog['link'] }}" />
    <link rel="next" href="{{ $blog['link'] }}">

    <title>十年之约</title>
    <style>

        * {
            color: #111827;
        }

        body{
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
                opacity: 0;
                transform: scale(1);
            }

            20% {
                opacity: 0;
                transform: scale(1);
            }

            40% {
                opacity: 0.3;
                transform: scale(1);
            }

            80% {
                opacity: 1;
                transform: scale(0.98);
            }

            90% {
                opacity: 1;
                transform: scale(0.98);
            }

            100% {
                opacity: 0.2;
                transform: scale(1.2);
            }
        }

        .botCenter {
            position: fixed;
            width: 100%;
            height: 50px;
            bottom: 2px;
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
            即将去往[{{ $blog['name'] }}]的十年<br/>加入时间为[{{ $blog['adopted_at'] ? date('Y-m-d', strtotime($blog['adopted_at'])) : '未知' }}]，十年之约第[{{ $blog['id'] }}]个博主
        </div>
    </div>

    <div class="botCenter">
        ↩️ Tips: <b>后退</b>网页可再次开往<br />
        <a href="https://www.foreverblog.cn/" target="_blank">foreverblog 十年之约</a>
    </div>

</div>

<script>
    window.setTimeout(()=>{location.href="{{ $blog['link'] }}"}, 3000);
</script>

</body>
</html>


