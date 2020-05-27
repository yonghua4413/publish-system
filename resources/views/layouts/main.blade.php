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
@include("common.category")

<div class="layui-container">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md8">
            @yield("content")
        </div>
        <div class="layui-col-md4">
            @include("common.rangeUser")
            @include("common.link")
        </div>
    </div>
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