<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>虫洞-随机访问十年之约成员博客</title>
    <link rel="stylesheet" href="/assets/css/wormhole.css">
</head>
<body>

<div class="container">
    <canvas id="c"></canvas>

    <div id="content">
        <h3>即将奔赴 <b id="name"></b> 的十年</h3>
        <div id="vortex">
        </div>
        <div class="meta">
            <p>加入时间: <span id="time"></span></p>
            <p>博主寄语</p>
            <p id="message">
                <span class="message-left">“</span>
                <span class="text"></span>
                <span class="message-right">”</span>
            </p>
        </div>
        <div class="footer">
            Tips: <b>后退</b>网页即可再次穿梭<b>虫洞</b><br/>
            <a href="https://www.foreverblog.cn/" target="_blank">
                <img id="logo" src="https://img.foreverblog.cn/logo_en_default.png">
            </a>
            <div class="time">2017-
                <script>document.write((new Date()).getFullYear())</script>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/jquery.min.js"></script>
<script>
    "use strict";

    var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

    function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var c = document.getElementById('c');
    var w = c.width = window.innerWidth;
    var h = c.height = window.innerHeight;
    var ctx = c.getContext('2d');
    var opts = {
        hexLength: 30,
        lenFn: function lenFn(_ref) {
            var len = _ref.len;
            var t = _ref.t;
            return len + Math.sin(t);
        },
        radFn: function radFn(_ref2) {
            var rad = _ref2.rad;
            var len = _ref2.len;
            var t = _ref2.t;
            var excitement = _ref2.excitement;
            return rad + (excitement + opts.propFn({
                len: len,
                t: t
            })) * 2 / 4;
        },
        propFn: function propFn(_ref3) {
            var len = _ref3.len;
            var t = _ref3.t;
            return len / opts.hexLength / 10 - t;
        },
        excitementFn: function excitementFn(_ref4) {
            var len = _ref4.len;
            var t = _ref4.t;
            return Math.sin(opts.propFn({
                len: len,
                t: t
            })) ** 2;
        },
        colorFn: function colorFn(_ref5) {
            var rad = _ref5.rad;
            var excitement = _ref5.excitement;
            var t = _ref5.t;
            return 'hsl(' + (rad / Math.TAU * 360 + t) + ', ' + excitement * 100 + '%, ' + (20 + excitement * 50) + '%)';
        },
        timeStep: .01,
        randomJig: 8,
        repaintColor: 'rgba(0,0,0,.1)'
    };
    var tick = 0;
    Math.TAU = 6.28318530717958647692;
    var vertices = [];

    var Vertex = function () {
        function Vertex(_ref6) {
            var x = _ref6.x;
            var y = _ref6.y;

            _classCallCheck(this, Vertex);

            this.len = Math.sqrt(x * x + y * y);
            this.rad = Math.acos(x / this.len) * (y > 0 ? 1 : -1) + .13;
            this.prevPoint = {
                x: x,
                y: y
            };
        }

        _createClass(Vertex, [{
            key: 'step',
            value: function step() {
                var excitement = opts.excitementFn({
                    len: this.len,
                    t: tick
                });
                var param = {
                    len: this.len,
                    rad: this.rad,
                    t: tick,
                    excitement: excitement
                };
                var nextLen = opts.lenFn(param);
                var nextRad = opts.radFn(param);
                var color = opts.colorFn(param);
                ctx.strokeStyle = color;
                ctx.lineWidth = excitement + .2;
                ctx.beginPath();
                ctx.moveTo(this.prevPoint.x, this.prevPoint.y);
                this.prevPoint.x = nextLen * Math.cos(nextRad) + Math.random() * (1 - excitement) ** 2 * opts.randomJig * 2 - opts.randomJig;
                this.prevPoint.y = nextLen * Math.sin(nextRad) + Math.random() * (1 - excitement) ** 2 * opts.randomJig * 2 - opts.randomJig;
                ctx.lineTo(this.prevPoint.x, this.prevPoint.y);
                ctx.stroke();
            }
        }], [{
            key: 'gen',
            value: function gen() {
                vertices.length = 0;
                var hexCos = Math.cos(Math.TAU / 12) * opts.hexLength;
                var hexSin = Math.sin(Math.TAU / 12) * opts.hexLength;
                var alternanceX = false;

                for (var x = 0; x < w; x += hexCos) {
                    var alternance = alternanceX = !alternanceX;

                    for (var y = 0; y < h; y += hexSin + opts.hexLength) {
                        alternance = !alternance;
                        vertices.push(new Vertex({
                            x: x - w / 2,
                            y: y + alternance * hexSin - h / 2
                        }));
                    }
                }
            }
        }]);

        return Vertex;
    }();

    Vertex.gen();
    ctx.fillStyle = '#222';
    ctx.fillRect(0, 0, w, h);

    var anim = function anim() {
        window.requestAnimationFrame(anim);
        tick += opts.timeStep;
        ctx.fillStyle = opts.repaintColor;
        ctx.fillRect(0, 0, w, h);
        ctx.translate(w / 2, h / 2);
        vertices.forEach(function (vertex) {
            return vertex.step();
        });
        ctx.translate(-w / 2, -h / 2);
    };

    anim();
    window.addEventListener('resize', function () {
        w = c.width = window.innerWidth;
        h = c.height = window.innerHeight;
        Vertex.gen();
        tick = 0;
        ctx.fillStyle = '#222';
        ctx.fillRect(0, 0, w, h);
    });
</script>
<script>
    function randomRgbaColor() {
        var r = Math.floor(Math.random() * (255 - 50 + 1) + 50);
        var g = Math.floor(Math.random() * (255 - 50 + 1) + 50);
        var b = Math.floor(Math.random() * (255 - 50 + 1) + 50);
        return 'rgb(' + r +', ' + g + ', ' + b + ', .95)';
    }

    var filter = JSON.parse(sessionStorage.getItem('filter') || '[]');
    $.ajax({
        url: '',
        type: 'post',
        dataType: 'json',
        data: {
            filter: filter,
            _token: $('[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            if (response.code) {
                var blog = response.data.blog;
                filter.push(blog.id);
                sessionStorage.setItem('filter', JSON.stringify(filter));
                $('#name').text(blog.name);
                $('#time').text(blog.adopted_at);
                $('#message .text').css('color', randomRgbaColor()).text(blog.message);
                $('#content').fadeIn().css('display', 'flex');
                setTimeout(function () {
                    window.location = blog.link;
                }, 4000);
            } else {
                alert(response.message)
            }
        },
        error: function () {
            alert('出错啦，请稍后再试～')
        }
    });

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
