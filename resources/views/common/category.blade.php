<div class="fly-panel fly-column">
    <div class="layui-container">
        <ul class="layui-clear">
            @if(!$spell)
                <li class="layui-hide-xs layui-this"><a href="/">首页</a></li>
            @else
                <li class="layui-hide-xs"><a href="/">首页</a></li>
            @endif
            @foreach($category as $item)
                @if($spell == $item['spell'])
                    <li class="layui-this"><a href="/category/{{$item['spell']}}.html">{{$item['name']}}</a></li>
                @else
                    <li ><a href="/category/{{$item['spell']}}.html">{{$item['name']}}</a></li>
                @endif
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