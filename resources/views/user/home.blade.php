@extends('layouts.base')

@section('content')
    <div class="fly-home fly-panel" style="background-image: url();">
        @if(empty($user_info->head_img))
            <img src="/res/images/avatar/default-user.png" alt="{{$user_info->user_name}}">
        @else
            <img src="{{$user_info->head_img}}" alt="{{$user_info->user_name}}">
        @endif
        {{--        <i class="iconfont icon-renzheng" title="Fly社区认证"></i>--}}
        <h1>
            {{$user_info->user_name}}
            <i class="iconfont icon-nan"></i>
            <!-- <i class="iconfont icon-nv"></i>  -->
        {{--            <i class="layui-badge fly-badge-vip">VIP3</i>--}}
        <!--
            <span style="color:#c00;">（管理员）</span>
            <span style="color:#5FB878;">（社区之光）</span>
            <span>（该号已被封）</span>
            -->
        </h1>

        <p style="padding: 10px 0; color: #5FB878;">认证信息：活动阁</p>

        <p class="fly-home-info">
            {{--            <i class="iconfont icon-kiss" title="飞吻"></i><span style="color: #FF7200;">66666 飞吻</span>--}}
            <i class="iconfont icon-shijian"></i><span>{{date('Y-m-d',$user_info->create_time)}} 加入</span>
        </p>

{{--        <p class="fly-home-sign">（人生仿若一场修行）</p>--}}

    </div>

    <div class="layui-container">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12 fly-home-jie">
                <div class="fly-panel">
                    <h3 class="fly-panel-title">{{$user_info->user_name}} 最近的帖子</h3>
                    <ul class="jie-row">
                        @if($user_blog)
                            @foreach($user_blog as $key => $value)
                                <li>
                                    @if($value->is_recommend == 1)
                                        <span class="fly-jing">荐</span>
                                    @endif
                                    <a href="" class="jie-title">{{$value->title}}</a>
                                    <i>{{date('Y-m-d h:i:s',$value->create_time)}}</i>
                                    <em class="layui-hide-xs">{{$value->read}}阅</em>
                                </li>
                            @endforeach
                        @else
                            <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><i
                                    style="font-size:14px;">没有发表任何求解</i></div>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
@endsection
