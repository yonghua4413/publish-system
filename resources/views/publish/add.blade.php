@extends("layouts.base")

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
                            <div class="layui-row layui-col-space15 layui-form-item">
                                <div class="layui-col-md3">
                                    <label class="layui-form-label">所在专栏</label>
                                    <div class="layui-input-block">
                                        <select lay-verify="required" name="category_id" lay-filter="column">
                                            <option>--请选择--</option>
                                            @foreach($category as $item)
                                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="layui-col-md9">
                                    <label for="title" class="layui-form-label">标题</label>
                                    <div class="layui-input-block">
                                        <input type="text" id="title" name="title" required lay-verify="required" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                            </div>

                            <div class="layui-row layui-col-space15 layui-form-item">
                                <div class="layui-col-md12">
                                    <label for="brief" class="layui-form-label">简介</label>
                                    <div class="layui-input-block">
                                        <input type="text" id="brief" name="brief" required lay-verify="required" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                            </div>

                            <div class="layui-row layui-col-space15 layui-form-item">
                                <div class="layui-col-md6">
                                    <label for="cover_img" class="layui-form-label">封面图</label>
                                    <div class="layui-input-block">
                                        <input type="text" id="cover_img" name="cover_img" required lay-verify="required" autocomplete="off" class="layui-input">
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
                                    <textarea id="content" name="content" required lay-verify="required" placeholder="详细描述" class="layui-textarea fly-editor" style="height: 260px;"></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn" lay-filter="*" lay-submit>立即发布</button>
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
    <script>
        layui.use(['upload', "layer", "jquery"], function(){
            var upload = layui.upload;
            var layer = layui.layer;
            var $ = layui.jquery;
            //执行实例
            var uploadInst = upload.render({
                elem: '#upload' //绑定元素
                ,url: 'https://apis.huodongge.cn/file/upload' //上传接口
                ,done: function(res){
                    //上传完毕回调
                    if(res.status == 0){
                        $('#cover_img').val(res.data.url);
                    } else {
                        layer.msg(res.message, {icon: 5});
                    }
                }
                ,error: function(){
                    layer.msg("上传异常", {"icon":5});
                }
            });
        });
    </script>
@endsection