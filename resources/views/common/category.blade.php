<div class="fly-panel fly-column">
    <div class="layui-container">
        <ul class="layui-clear">
            <li class="layui-hide-xs layui-this"><a href="/">首页</a></li>
            @foreach($category as $item)
                <li><a href="/category/{{$item['spell']}}.html">{{$item['name']}}</a></li>
            @endforeach
            <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><span class="fly-mid"></span></li>
        </ul>

        <div class="fly-column-right layui-hide-xs">
            <span class="fly-search"><i class="layui-icon"></i></span>
            @if($is_login)
            <a href="jie/add.html" class="layui-btn layui-btn-primary">我的发布</a>
            @endif
            <a href="jie/add.html" class="layui-btn">马上发布+</a>
        </div>
    </div>
</div>