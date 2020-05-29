@extends("layouts.base")

@section("css")
<link href="/editor/themes/default/css/ueditor.css" type="text/css" rel="stylesheet">
@endsection

@section("content")
    <div class="fly-panel" pad20 style="padding-top: 5px;">
        @if(!$is_login)
        <div class="fly-none"><span style="color: red;">----请先登陆----</span></div>
        @else
        <div class="layui-form layui-form-pane">
            <div class="layui-tab layui-tab-brief" lay-filter="user">
                <ul class="layui-tab-title">
                    <li class="layui-this">发表新帖</li>
                </ul>
                <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
                    <div class="layui-tab-item layui-show">
                        <form action="" method="post">
                            @csrf
                            <div class="layui-row layui-col-space15 layui-form-item">
                                <div class="layui-col-md3">
                                    <label class="layui-form-label">所在专栏</label>
                                    <div class="layui-input-block">
                                        <select id="category_id" name="category_id" lay-filter="column">
                                            <option value="0">--请选择--</option>
                                            @foreach($category as $item)
                                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="layui-col-md9">
                                    <label for="title" class="layui-form-label">标题</label>
                                    <div class="layui-input-block">
                                        <input type="text" id="title" name="title" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                            </div>

                            <div class="layui-row layui-col-space15 layui-form-item">
                                <div class="layui-col-md12">
                                    <label for="brief" class="layui-form-label">简介</label>
                                    <div class="layui-input-block">
                                        <input type="text" id="brief" name="brief" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                            </div>

                            <div class="layui-row layui-col-space15 layui-form-item">
                                <div class="layui-col-md6">
                                    <label for="cover_img" class="layui-form-label">封面图</label>
                                    <div class="layui-input-block">
                                        <input type="text" id="cover_img" name="cover_img" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-col-md3">
                                    <button type="button" class="layui-btn" id="upload">
                                        <i class="layui-icon">&#xe67c;</i>上传图片
                                    </button>
                                </div>
                            </div>

                            <div class="layui-form-item layui-form-text">
                                <div class="layui-input-block">
                                    <script id="container" height="500" name="content" type="text/plain"></script>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button id="TencentCaptcha" class="layui-btn">立即发布</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection

@section("js")
<script>var appId = "{{env('CAPTCHA_APP_ID')}}";</script>
<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
<script src="/js/user/publish.js"></script>
<script src="/js/jquery-3.0.0.min.js"></script>
<script type="text/javascript" src="/editor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/editor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container', {
        'initialFrameHeight' : 300
    });
</script>

@endsection