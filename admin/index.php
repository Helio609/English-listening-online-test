<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后台-崇仁中学英语听力系统</title>
    <link rel="stylesheet" href="../css/layui.css">
</head>
<body style="background-color: #F2F2F2">

<ul class="layui-nav" lay-filter="">
    <li class="layui-nav-item layui-this"><a href="#">后台首页</a></li>
    <li class="layui-nav-item"><a href="../index.php">回到首页</a></li>
    <li class="layui-nav-item"><a href="../about.php">关于</a></li>
</ul>

<div class="layui-container">
    <div class="layui-row">
        <div class="layui-col-md12">
            <button class="layui-btn layui-btn-fluid layui-btn-radius layui-btn-normal" onclick="addT()">点击我添加一个听力测试</button>
        </div>
    </div>
    <div class="layui-row">
        <div class="layui-col-md12">
            <table class="layui-table">
                <colgroup>
                    <col width="150">
                    <col width="200">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>名称</th>
                    <th>备注</th>
                    <th>引用</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once ('../cron/dbs.class.php');
                $conn = new DBS();
                $conn->query('SET NAMES utf8');
                $sql = "SELECT * FROM `exercise`";
                if(($exercise = $conn ->query($sql)) != false){
                    while(($row = $exercise->fetch_assoc())!=null){
                        echo sprintf('
                <tr>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>
                        <div class="layui-btn-group">
                            <button class="layui-btn layui-btn-primary layui-btn-sm uploadClass" lay-data="{data:{\'id\' : %s}}">
                                <i class="layui-icon">&#xe654;</i> 
                            </button>
                            <button class="layui-btn layui-btn-primary layui-btn-sm" id="%s" onclick="editT(this)">
                                <i class="layui-icon">&#xe642;</i>
                            </button>
                            <button class="layui-btn layui-btn-primary layui-btn-sm" id="%s" onclick="deleteT(this)">
                                <i class="layui-icon">&#xe640;</i>
                            </button>
                        </div>
                    </td>
                </tr>',$row['id'],$row['name'],$row['remark'],$row['refer'],$row['id'],$row['id'],$row['id']);
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../layui.js"></script>
<script>
    var layer,form ,element= null;
    layui.use(['layer', 'form','element'], function(){
        layer = layui.layer,form = layui.form , element = layui.element;
    });

    layui.use(['upload'],function () {
        var upload = layui.upload;
        upload.render({
            elem: '.uploadClass'
            ,url: '../upload/'
            ,before: function (obj) {
                layer.load();
            }
            ,done: function(res, index, upload){
                layer.closeAll('loading');
                if(res.code == 0){
                    layer.msg('上传成功了~~~');
                    setTimeout(function () {
                        location.reload();
                    },1000);
                }else{
                    layer.msg('因为玄学原因，上传失败，影响了0条(这不是废话吗...)');
                }
                var item = this.item;
            }
            ,error: function () {
                layer.closeAll('loading');
            }
            ,accept: 'audio'
        })
    })
    function editT(obj) {
        layer.msg('你想修改听力题目？没门~~~~~作者正在施工中~~~');
    }
    function deleteT(obj) {
        var http = new XMLHttpRequest();
        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                var result = JSON.parse(http.responseText);
                var msg = result['msg']
                if(msg == 'success'){
                    layer.msg('删除成功，影响了1条(这不是废话吗...)');
                    setTimeout(function () {
                        location.reload();
                    },1000);
                }else{
                    layer.msg('因为玄学原因，删除失败，影响了0条(这不是废话吗...)')
                }
            }
        }
        http.open('POST','handle.php?t='+Math.random());
        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        http.send('id='+obj.id+'&handle=delete');
    }
    function addT(){
        window.location.href = 'add.php';
    }

</script>
<footer>
    <p style="text-align: center">© 2019 ListenEnglish MIT license</p>
</footer>
</body>
</html>