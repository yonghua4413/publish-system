<a href="user/home.html" class="fly-avatar">
    <img src="https://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg"
         alt="">
</a>
<h2>
    <a class="layui-badge">{{$item['category_name']}}</a>
    <a href="jie/detail.html">{{$item['title']}}</a>
</h2>
<div class="fly-list-info">
    <a href="user/home.html" link>
        <cite>{{$item['user_name']}}</cite>
        @if($item['user_status'])
            <i class="iconfont icon-renzheng" title="认证用户"></i>
        @endif
    </a>
    @if($item['create_time'])
        <span>{{date("Y-m-d H:i", $item['create_time'])}}</span>
    @endif
    <span class="fly-list-nums">{{$item['read']}} 阅读</span>
</div>
<div class="fly-list-badge"></div>