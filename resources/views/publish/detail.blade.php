@extends("layouts.main")

@section("content")
    <div class="fly-panel detail-box">
        <h1>{{$publish['title']}}</h1>
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
        </div>
        <div class="detail-body">
            <p>{!! html_entity_decode($publish['content']) !!}</p>
        </div>
    </div>
@endsection
