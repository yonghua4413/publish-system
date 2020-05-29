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

    //提交
    $(function () {
        $('#TencentCaptcha').on("click", function (event) {
            if ( event && event.preventDefault ) {
                event.preventDefault();
            }else {
                window.event.returnValue = false;
                return false;
            }

            var category_id = $("#category_id").val().trim();
            var title = $("#title").val().trim();
            var brief = $("#brief").val().trim();
            var cover_img = $("#cover_img").val().trim();

            if(category_id == "" || category_id == 0 || category_id == undefined){
                return layer.alert("专栏必选！", {icon: 2,'title':"系统提示"});
            }
            if(title == "" || title == undefined){
                return layer.alert("标题不能为空！", {icon: 2,'title':"系统提示"});
            }
            if(brief == "" || brief == undefined){
                return layer.alert("简介不能为空！", {icon: 2,'title':"系统提示"});
            }

            var that = $(this);
            var originText = $(this).text();
            that.text("验证请求");
            var captcha = new TencentCaptcha(appId, function(res) {
                if(res.ret == 0) {
                    layer.msg("验证成功，正在提交！", {icon: 1});
                    var _data = $("form").serialize();
                    _data += "&ticket=" + res.ticket + "&randstr=" + res.randstr;
                    $.post("/publish/doAdd", _data, function (data) {
                        if(data.status == 0) {
                            layer.alert(data.message, function () {
                                window.location.href = data.data.redirect;
                            });
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
