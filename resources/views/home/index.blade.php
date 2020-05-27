<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    @include("common.seo")
    @include("common.common_css")
</head>
<body>

@include("common.header")
@include("common.category")

<div class="layui-container">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md8">
            <div class="fly-panel">
                <div class="fly-panel-title fly-filter"><a>置顶</a></div>
                <ul class="fly-list">
                    @foreach($recommend as $item)
                    <li>@include("common.publishItem")</li>
                    @endforeach
                </ul>
            </div>

            <div class="fly-panel" style="margin-bottom: 0;">

                <div class="fly-panel-title fly-filter">
                    <span class="fly-filter-left layui-hide-xs">
                        @if($type == 1)
                            <a href="/?type=1" class="layui-this">按最新</a>
                        @else
                            <a href="/?type=1">按最新</a>
                        @endif
                        <span class="fly-mid"></span>
                        @if($type == 2)
                            <a href="/?type=2" class="layui-this">按热门</a>
                        @else
                            <a href="/?type=2">按热门</a>
                        @endif
                    </span>
                </div>

                <ul class="fly-list">
                    @foreach($list as $item)
                        <li>@include("common.publishItem")</li>
                    @endforeach
                </ul>
            </div>
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
</body>
</html>