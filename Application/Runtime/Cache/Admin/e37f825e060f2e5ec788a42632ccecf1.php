<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo (ADMIN_META); echo (ADMIN_CSS); echo (ADMIN_COMPATIBLE); echo (ADMIN_JS); echo ($Assigndata); ?>
        <link rel="stylesheet" href="/Public/admin/css/common.css">
        <script type="text/javascript" src="/Public/Plugin/layer-v3.0.2/layer.js"></script>
        <script type="text/javascript" src="/Public/admin/js/common.js"></script>
        <script type="text/javascript" src="/Public/Plugin/socket.io.client.js"></script>
    </head>
    <body>
        <!--添加信息-->
        <div class="container">
            <form method="post" action="#"  class="form-horizontal"  id="save-form" style="margin-top: 20px;">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">编&#12288;&#12288;号</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="mac" name="mac" placeholder="请输入编号">
                    </div>
                    <label class="col-sm-2"><span class="tipMsg">*</span></label>
                </div>
                <!--                <div class="form-group">
                                    <label for="category_name" class="col-sm-2 control-label">类&#12288;&#12288;别</label>
                                    <div class="col-sm-8">
                                        <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <span class="help-block">一个较长的帮助文本块，超过一行，
                                            需要扩展到下一行。本实例中的帮助文本总共有两行。</span>
                                    </div>
                                    <label class="col-sm-2"><span class="tipMsg">*必选</span></label>
                                </div>-->
                <div class="form-group">
                    <label for="editor" class="col-sm-2 control-label">内&#12288;&#12288;容</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="3" id="ml"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9">
                        <button type="button" class="btn btn-primary" onclick="tjml()">执&#12288;&#12288;行</button>
                        <button type="button" class="btn btn-default" onclick="javascript:$('#ml').html('getMac')">MAC地址</button>
                        <button type="button" class="btn btn-default" onclick="javascript:$('#ml').html('getPlayConfig')">播放配置</button>
                       <button type="button" class="btn btn-default" onclick="javascript:$('#ml').html('playAd')">播放广告</button>
                       <button type="button" class="btn btn-default" onclick="javascript:$('#ml').html('closeAd')">关闭广告</button>
                        <!--<button type="button" class="btn btn-warning" onclick="javascript:void(window.location.href = '/index.php/Admin/Socket/showList')">取&#12288;&#12288;消</button>-->
                    </div>
                </div>
            </form>
        </div>
        <div class="hhh">

        </div>

    </body>
    <script type="text/javascript">
        var SOCKET = new Object();
        $(function () {
            SOCKET = io.connect('ws://127.0.0.1:3000');
            if (SOCKET.connected) { //判断socket连接,是否应该判断终端是否在线？
                SOCKET.emit('api-i', {'sendId': "23232323", 'toId': "23232323", 'ml': 'login'});
            }
            slave();
        });

        function tjml() {
            var mac = $("#mac").val();
            var ml = $("#ml").val();
            SOCKET.emit('api-i', {'sendId': "23232323", 'toId': mac, 'ml': ml});
        }

        /**
         * 对终端控制的一些操作
         * @returns {undefined}
         */
        function slave() {
            //终端控制
            console.log("本终端编号：23232323");

            SOCKET.on("api-o", function (data) {
                if (data.toId == "23232323") {
                    var str = '<div class="panel panel-success">'
                            + '<div class="panel-heading">'
                            + '<h3 class="panel-title">' + data.sendId + '</h3><a href="#" style="float:right;margin-top:-18px;">&times;</a>'
                            + '<h3 class="panel-title" style="float:right;margin-top:-18px;">' + getCurrentDatetime() + '</h3>'
                            + '</div>'
                            + '<div class="panel-body">'
                            + data.data
                            + '</div>'
                            + '</div>';
                    $(".hhh").prepend(str);
                } else {

                }
            });
        }
        /**
         * 获取当前日期时间
         * @returns {String}
         */
        function getCurrentDatetime() {
            var date = new Date();
            var y = date.getFullYear();
            var m = date.getMonth() + 1;
            m = m > 9 ? m : '0' + m;
            var d = date.getDate();
            d = d > 9 ? d : '0' + d;
            var h = date.getHours();
            h = h > 9 ? h : '0' + h;
            var i = date.getMinutes();
            i = i > 9 ? i : '0' + i;
            var s = date.getSeconds();
            s = s > 9 ? s : '0' + s;
            return y + '-' + m + '-' + d + ' ' + h + ':' + i + ':' + s;
        }
    </script>
</html>