<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    @include("common.seo")
    @include("common.common_css")
    @yield("css")
</head>
<body>

@include("common.header")

<div class="layui-container fly-marginTop">
    @yield("content")
</div>

@include("common.footer")
<script src="/res/layui/layui.js"></script>
<script>
    layui.config({
        version: "3.0.0"
        ,base: '/res/mods/' //这里实际使用时，建议改成绝对路径
    }).extend({
        fly: 'index'
    }).use('fly');
</script>
@yield("js")
</body>
</html>
