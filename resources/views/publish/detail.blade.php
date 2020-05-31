@extends("layouts.main")

@section("content")
    <div class="fly-panel detail-box">
        @if($publish)
            @if($publish['is_show'] == 0)
                <h1>{{$publish['title']}}【未审核完成】</h1>
            @else
                <h1>{{$publish['title']}}</h1>
            @endif
        <div class="fly-detail-info" style="text-align: right;">
            <span><i class="iconfont" title="人气">&#xe60b;</i> {{$publish['read']}}</span>
        </div>
        <div class="detail-about">
            <a class="fly-avatar" href="/user/home.html">
                <img style="border-radius:22px;" src="{{$publish['head_img']}}" alt="贤心">
            </a>
            <div class="fly-detail-user">
                <a href="" class="fly-link">
                    <cite>{{$publish['user_name']}}</cite>
                    @if($publish['user_status'])
                    <i class="iconfont icon-renzheng" title="认证信息："></i>
                    @endif
                </a>
                <span>{{$publish['create_time']}}</span>
            </div>
            @if($user['id'] == $publish['user_id'])
            <div class="detail-hits">
                <span class="layui-btn layui-btn-xs jie-admin" type="edit"><a href="/publish/modify/{{$publish['id']}}.html">编辑此贴</a></span>
            </div>
            @endif
        </div>
        <div id="content" class="detail-body">
            {!! html_entity_decode($publish['content']) !!}
        </div>
        @else
            <h1>内容不存在或正在审核中</h1>
        @endif
    </div>
@endsection
