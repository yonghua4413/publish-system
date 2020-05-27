<div class="fly-header layui-bg-black">
    <div class="layui-container">
        <a class="fly-logo" href="/">
            <img src="/res/images/logo.png" alt="layui">
        </a>

        <ul class="layui-nav fly-nav-user">
            @if(!$is_login)
            <!-- 未登入的状态 -->
            <li class="layui-nav-item">
                <a class="iconfont icon-touxiang layui-hide-xs" href="/user/login.html"></a>
            </li>
            <li class="layui-nav-item">
                <a href="/user/login.html">登入</a>
            </li>
            <li class="layui-nav-item">
                <a href="/user/reg.html">注册</a>
            </li>
            @else
            <!-- 登入后的状态 -->
                <li class="layui-nav-item">
                    <a class="fly-nav-avatar" href="javascript:;">
                        <cite class="layui-hide-xs">{{$user['user_name']}}</cite>
                        @if($user['status'])
                        <i class="iconfont icon-renzheng layui-hide-xs" title="已认证"></i>
                        @endif
                        @if(!empty($user['head_img']))
                            <img src="{{$user['head_img']}}">
                        @else
                            <img src="/res/images/avatar/default-user.png"/>
                        @endif
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="/user/set.html"><i class="layui-icon">&#xe620;</i>基本设置</a></dd>
                        <dd><a href="/user/{{$user['id']}}.html"><i class="layui-icon" style="margin-left: 2px; font-size: 22px;">&#xe68e;</i>我的主页</a>
                        </dd>
                        <hr style="margin: 5px 0;">
                        <dd><a href="/user/loginOut" style="text-align: center;">退出</a></dd>
                    </dl>
                </li>
            @endif
        </ul>
    </div>
</div>