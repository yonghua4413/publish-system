<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    @include("common.seo")
    @include("common.common_css")
</head>
<body>

@include("common.header")

<div class="layui-container fly-marginTop">
    @yield("content")
</div>

@include("common.footer")
<script src="/res/layui/layui.js"></script>
@yield("js")
</body>
</html>