<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
<script>
    var appId = "{{env('CAPTCHA_APP_ID')}}";
    layui.use(['layer','jquery'], function(){
        var layer = layui.layer;
        var $ = layui.jquery;

        $(function () {
            $('#TencentCaptcha').on("click", function (event) {
                if ( event && event.preventDefault ) {
                    event.preventDefault();
                }else {
                    window.event.returnValue = false;
                    return false;
                }
                var email = $("#email").val().trim();
                var password = $("#password").val().trim();
                if(email == "" || email == undefined){
                    return layer.alert("账户不能为空！", {icon: 2,'title':"系统提示"});
                }
                if(password == "" || password == undefined){
                    return layer.alert("密码不能为空！", {icon: 2,'title':"系统提示"});
                }
                var that = $(this);
                var originText = $(this).text();
                that.text("验证请求");
                var captcha = new TencentCaptcha(appId, function(res) {
                    console.log(res);
                    if(res.ret == 0) {
                        layer.msg("验证成功，正在登陆！", {icon: 1});
                        var _data = {
                            '_token':$('input[name="_token"]').val(),
                            'email':email,
                            'password':password,
                            'ticket':res.ticket,
                            'randstr':res.randstr
                        };
                        $.post("/user/doLogin", _data, function (data) {
                            if(data.status == 0) {
                                window.location.href = data.data.redirect;
                                return;
                            }
                            layer.msg(data.message, {icon: 2});
                            that.text(originText);
                            return;
                        });
                        return ;
                    }
                    layer.alert("您主动取消验证", {icon: 2,'title':"系统提示"});
                    that.text(originText);
                });
                captcha.show(); // 显示验证码
            })
        });
    });
    
</script>