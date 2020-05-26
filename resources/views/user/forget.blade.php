<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    @include("common.seo")
    @include("common.common_css")
</head>
<body>

@include("common.header")

<div class="layui-container fly-marginTop">
    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="user">
            <ul class="layui-tab-title">
                <li><a href="login.html">登入</a></li>
                <li class="layui-this">找回密码</li>
            </ul>
            <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
                <div class="layui-tab-item layui-show">
                    <div class="layui-form layui-form-pane">
                        <form method="post">
                            <div class="layui-form-item">
                                <label for="L_email" class="layui-form-label">邮箱</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_email" name="email" required lay-verify="required" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_vercode" class="layui-form-label">人类验证</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid">
                                    <span style="color: #c00;">12</span>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn" alert="1" lay-filter="*" lay-submit>提交</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

@include("common.footer")

<script src="/res/layui/layui.js"></script>

</body>
</html>