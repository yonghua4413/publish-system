@if(is_array($item))
    <a href="/publish/detail/{{$item['id']}}.html" class="fly-avatar">
        @if(!empty($item['cover_img']))
            <img src="{{$item['cover_img']}}" alt="">
        @else
            <img src="{{$item['category_img']}}" alt="">
        @endif
    </a>
    <h2>
        <a class="layui-badge">{{$item['category_name']}}</a>
        <a href="/publish/detail/{{$item['id']}}.html">{{$item['title']}}</a>
    </h2>
    <div class="fly-list-info">
        <a href="/publish/detail/{{$item['id']}}.html" link>
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
@else
    <a href="/publish/detail/{{$item->id}}.html" class="fly-avatar">
        @if(!empty($item->cover_img))
            <img src="{{$item->cover_img}}" alt="">
        @else
            <img src="{{$item->category_img}}" alt="">
        @endif
    </a>
    <h2>
        <a class="layui-badge">{{$item->category_name}}</a>
        <a href="/publish/detail/{{$item->id}}.html">{{$item->title}}</a>
    </h2>
    <div class="fly-list-info">
        <a href="/publish/detail/{{$item->id}}.html" link>
            <cite>{{$item->user_name}}</cite>
            @if($item->user_status)
                <i class="iconfont icon-renzheng" title="认证用户"></i>
            @endif
        </a>
        @if($item->create_time)
            <span>{{date("Y-m-d H:i", $item->create_time)}}</span>
        @endif
        <span class="fly-list-nums">{{$item->read}} 阅读</span>
    </div>
    <div class="fly-list-badge"></div>
@endif