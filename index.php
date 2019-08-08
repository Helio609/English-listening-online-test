<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>首页-崇仁中学英语听力系统</title>
    <link rel="stylesheet" href="./css/layui.css">
</head>
<body style="background-color: #F2F2F2">

<ul class="layui-nav" lay-filter="">
    <li class="layui-nav-item layui-this"><a href="index.php">首页</a></li>
    <li class="layui-nav-item"><a href="about.php">关于</a></li>
</ul>
<div class="layui-container">
    <div class="layui-row">
        <?php
        require_once ('cron/dbs.class.php');
        $conn = new DBS();
        $conn->query('SET NAMES utf8');
        $sql = "SELECT * FROM `exercise`";
        if(($exercise = $conn ->query($sql)) != false){
            while(($row = $exercise->fetch_assoc())!=null){
                echo sprintf('
            <div class="layui-card layui-col-md12">
                <div class="layui-card-header" style="font-size: 20px;height: auto;line-height: normal;">%s</div>
                <div class="layui-card-body" style="font-size: 15px;">
                    %s
                    <br/>
                    <a href="%s" target="_blank" style="color: #1E9FFF;">点我测试</a>
                </div>
            </div>',$row['name'],$row['remark'],'exercise.php?id='.$row['id']);
            }
        }else{
            exit('Nothing found!');
        }
        ?>
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