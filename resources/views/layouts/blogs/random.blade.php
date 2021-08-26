<!DOCTYPE HTML>
<html>
<head>
    <title>十年之约随机跳转-Demo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<p>{{ $id }}->{{ $name }}->{{ $link }}->{{ $message }}->{{ $adopted_at }}</p>

<script>
    setTimeout(() => {
        location.href = "{{ $link }}";
    }, 3000)
</script>
</body>
</html>
