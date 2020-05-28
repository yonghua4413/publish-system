<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
<script>
    console.log(layui);
    var appId = "{{env('CAPTCHA_APP_ID')}}";
    var Token = "{{@csrf_token()}}";
    layui.use(['layer', 'jquery','upload'], function () {
        var layer = layui.layer;
        var $ = layui.jquery;
        var upload = layui.upload;

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#upload'
            ,url: 'https://imgkr.com/api/files/upload' //改成您自己的上传接口
            ,headers:{_token:Token}
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#head_img').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.code == 200){
                    var email = $("#email").val().trim();
                    var _data = {
                        '_token': $('input[name="_token"]').val(),
                        'email': email,
                        'head_img': res.data
                    };
                    $.post("/user/setHeadImg", _data, function (data) {
                        if(data.status == 0) {
                            return layer.alert(data.message, function () {
                                window.location.href = data.data.redirect;
                            });
                        }
                        return layer.msg(data.message, {icon: 2});
                    });
                }
                //上传成功
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });


        //修改密码提交
        $(function () {
            $('#TencentCaptcha').on("click", function (event) {
                if (event && event.preventDefault) {
                    event.preventDefault();
                } else {
                    window.event.returnValue = false;
                    return false;
                }
                var email = $("#email").val().trim();
                var now_pass = $("#now_pass").val().trim();
                var password = $("#password").val().trim();
                var re_password = $("#re_password").val().trim();

                if (now_pass == "" || now_pass == undefined) {
                    return layer.alert("当前密码不能为空！", {icon: 2, 'title': "系统提示"});
                }
                if ((password.length < 6 || password.length > 16) || (re_password.length < 6 || re_password.length > 16)) {
                    return layer.alert("密码长度不正确！", {icon: 2, 'title': "系统提示"});
                }
                if (password == "" || password == undefined) {
                    return layer.alert("新密码不能为空！", {icon: 2, 'title': "系统提示"});
                }
                if (re_password == "" || re_password == undefined) {
                    return layer.alert("确认密码不能为空！", {icon: 2, 'title': "系统提示"});
                }
                if (password != re_password) {
                    return layer.alert("两次密码不一致！", {icon: 2, 'title': "系统提示"});
                }
                var that = $(this);
                var originText = $(this).text();
                that.text("验证请求");
                var captcha = new TencentCaptcha(appId, function (res) {
                    console.log(res);
                    if (res.ret == 0) {
                        // layer.msg("验证成功，正在登陆！", {icon: 1});
                        var _data = {
                            '_token': $('input[name="_token"]').val(),
                            'email': email,
                            'now_pass': now_pass,
                            'password': password,
                            're_password': re_password,
                            'ticket': res.ticket,
                            'randstr': res.randstr
                        };
                        $.post("/user/rePass", _data, function (data) {
                            if (data.status == 0) {
                                layer.alert(data.message, function () {
                                    window.location.href = data.data.redirect;
                                });
                                return;
                            }
                            layer.msg(data.message, {icon: 2});
                            that.text(originText);
                            return;
                        });
                        return;
                    }
                    layer.alert("您主动取消验证", {icon: 2, 'title': "系统提示"});
                    that.text(originText);
                });
                captcha.show(); // 显示验证码
            })
        });
    });

</script>
