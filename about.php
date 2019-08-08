<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>关于ListenEnglish系统</title>
    <link rel="stylesheet" href="./css/layui.css">
</head>
<body style="background-color: #F2F2F2">

<ul class="layui-nav" lay-filter="">
    <li class="layui-nav-item"><a href="index.php">首页</a></li>
    <li class="layui-nav-item layui-this"><a href="about.php">关于</a></li>
</ul>
<div class="layui-container">
    <div class="layui-row">
        <div class="layui-col-md12">

            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                <legend>开发时间线</legend>
            </fieldset>
            <ul class="layui-timeline">
                <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis"></i>
                    <div class="layui-timeline-content layui-text">
                        <h3 class="layui-timeline-title">2019年1月29日</h3>
                        <p>
                            ListenEnglish 的一切准备工作似乎都已到位。发布之弦，一触即发。
                            <br>不枉近百个日日夜夜与之为伴。因小而大，因弱而强。
                            <br>无论它能走多远，抑或如何支撑？至少我曾倾注全心，无怨无悔 <i class="layui-icon"></i>
                        </p>
                    </div>
                </li>
                <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis"></i>
                    <div class="layui-timeline-content layui-text">
                        <h3 class="layui-timeline-title">2019年1月30日</h3>
                        <p>杜甫的思想核心是儒家的仁政思想，他有<em>“致君尧舜上，再使风俗淳”</em>的宏伟抱负。个人最爱的名篇有：</p>
                        <ul>
                            <li>《登高》</li>
                            <li>《茅屋为秋风所破歌》</li>
                        </ul>
                    </div>
                </li>
                <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis"></i>
                    <div class="layui-timeline-content layui-text">
                        <div class="layui-timeline-title">过去</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<script src="./layui.js"></script>
<script>
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer
            ,form = layui.form;
    });
    layui.use(['element'],function () {
        var element = layui.element;
    });
</script>
<footer>
    <p style="text-align: center">© 2019 ListenEnglish MIT license</p>
</footer>
</body>
</html>