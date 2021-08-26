<!DOCTYPE HTML>
<html>
<head>
    <title>十年之约随机跳转-Demo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<p>{{ $blog['id'] }}->{{ $blog['name'] }}->{{ $blog['link'] }}->{{ $blog['message'] }}->{{ $blog['adopted_at'] }}</p>

<script>
    setTimeout(() => {
        location.href = "{{ $blog['link'] }}";
    }, 3000)
</script>
</body>
</html>
