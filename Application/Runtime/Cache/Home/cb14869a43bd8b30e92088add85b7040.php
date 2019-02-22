<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <link rel="stylesheet" href="/Public/home/css/mui.min.css">
        <link rel="stylesheet" href="/Public/home/css/icons-extra.css" type="text/css"/>
        <link rel="stylesheet" href="/Public/home/css/common.css">
        <link rel="stylesheet" href="/Public/home/css/notice_wxdetail.css">
        <script src="/Public/home/js/jquery-1.11.0.js"></script>
        <script src="/Public/home/js/mui.min.js"></script>
        <script type="text/javascript">
            //启用双击监听
            mui.init({
                gestureConfig: {
                    doubletap: true,
                },
            });
        </script>
        <?php echo ($Assigndata); ?>
        <script src="/Public/home/js/common.js"></script>
        <script src="/Public/home/js/notice_wxdetail.js"></script>
    </head>

    <body>
        <div class="wrapper">
            <!--            <header class="mui-bar mui-bar-nav" style="background-color: #eee;">
                            <a class="mui-icon mui-icon-back mui-pull-left header-a-l" onclick="history.back(-1);" style="background-color: #eee;">werwerw</a>
                            <h1 class="mui-title head" style="background-color: #eee;"><span></span></h1>
                        </header>-->


            <!--主体-->
            <div class="mui-content body" style="background-color: #fff;">

                <div class="mui-row">
                    <div class="mui-col-sm-12 mui-col-xs-12 title"></div>
                </div>
                <div class="mui-row">
                    <div class="mui-col-sm-12 mui-col-xs-12" style="margin-top: 5px;">
                        <div class="author">延庆生态农业循环经济科普基地</div>
                        <div class="addtime">昨天</div>
                    </div>
                </div>
                <div class="mui-row">
                    <div class="mui-col-sm-12 mui-col-xs-12 content"></div>
                </div>
                <div class="mui-row">
                    <div class="mui-col-sm-6 mui-col-xs-6 viewnum">阅读&#12288;234234</div>
                    <!--<div class="mui-col-sm-6 mui-col-xs-6 zan"><span class="mui-icon-extra mui-icon-extra-calc"></span></div>-->
                </div>
                
            </div>
        </div>

    </body>

</html>