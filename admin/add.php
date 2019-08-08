<?php
/*
 * 注:这就是最烦的部分了，写代码的时候是真的佛系......
 * */
require_once ('../cron/dbs.class.php');
$conn = new DBS();
$num = isset($_POST['num']) ? $_POST['num'] :null;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>添加-崇仁中学英语听力系统</title>
    <link rel="stylesheet" href="../css/layui.css">
</head>
<body style="background-color: #F2F2F2">

<ul class="layui-nav" lay-filter="">
    <li class="layui-nav-item"><a href="index.php">后台首页</a></li>
    <li class="layui-nav-item layui-this"><a href="#">添加听力材料</a></li>
    <li class="layui-nav-item"><a href="../index.php">回到首页</a></li>
    <li class="layui-nav-item"><a href="../about.php">关于</a></li>
</ul>
<div class="layui-container">
    <div class="layui-row">
        <div class="layui-col-md12">
            <form class="layui-form layui-form-pane" action="add.php" method="post">
                <?php
                if($num){
                    echo '
                    <div class="layui-form-item">
                        <label class="layui-form-label">名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" required  lay-verify="required" placeholder="请输入听力名称" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">介绍</label>
                        <div class="layui-input-block">
                            <input type="text" name="remark" required  lay-verify="required" placeholder="听力材料的介绍" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">原文</label>
                        <div class="layui-input-block">
                            <input type="text" name="text" placeholder="可以不写哦" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    ';
                    for($i = 0 ;$i < $num ;$i++){
                        echo sprintf('
                    <div class="layui-form-item">
                        <label class="layui-form-label">第%s题</label>
                        <div class="layui-input-block">
                            <input type="text" name="title%s" required  lay-verify="required" placeholder="请输入题目" autocomplete="off" class="layui-input">
                            <input type="text" name="answer%sA" required  lay-verify="required" placeholder="A选项" autocomplete="off" class="layui-input">
                            <input type="text" name="answer%sB" required  lay-verify="required" placeholder="B选项" autocomplete="off" class="layui-input">
                            <input type="text" name="answer%sC" required  lay-verify="required" placeholder="C选项" autocomplete="off" class="layui-input">
                            <input type="text" name="answer%s" required  lay-verify="required|ABC" placeholder="正确答案" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                        ', $i+1,$i+1,$i+1,$i+1,$i+1,$i+1);
                    }
                    echo '
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="go">提交</button>
                    </div>
                </div>';
                }else{
                    echo '
                <div class="layui-form-item">
                    <label class="layui-form-label">题目数量</label>
                    <div class="layui-input-block">
                        <input type="text" name="num" required  lay-verify="required" placeholder="请输入题目数量" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="toMake">生成</button>
                    </div>
                </div>';
                }
                ?>
            </form>
        </div>
    </div>
</div>
<script src="../layui.js"></script>
<script>
    <?php if($num){echo 'var make = true;var num = '.$num.';';}?>
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer
            ,form = layui.form;
        if(make == true){
            layer.msg('友情提示:可以使用TAB键进行焦点跳转哦~');
        }

        form.verify({
            ABC: function(value, item){
                if(!(value == 'A' || value == 'B' || value == 'C')){
                    return '答案中包含有非法字符！';
                }
            }
        });

        form.on('submit(go)',function (data) {
            var maker = data.field;
            var name = maker['name'];
            var remark  = maker['remark'];
            var text = maker['text'];
            var submit = '';
            var submitAns = '';
            var temp = '';
            var title = '';
            var titNum = 0;
            var ansA = '';
            var ansB = '';
            var ansC = '';
            var ans = '';
            for(var i = 0 ; i < num ; i++){
                titNum = i + 1;
                title = maker['title'+titNum];
                ansA = maker['answer' + titNum + 'A'];
                ansB = maker['answer' + titNum + 'B'];
                ansC = maker['answer' + titNum + 'C'];
                ans =  maker['answer' + titNum];
                if(title.charAt(title.length-1) != '?') {
                    title = title + '?';
                }
                if(ansA.charAt(ansA.length-1) != '.'){
                    ansA = ansA + '.';
                }
                if(ansB.charAt(ansB.length-1) != '.'){
                    ansB = ansB + '.';
                }
                if(ansC.charAt(ansC.length-1) != '.'){
                    ansC = ansC + '.';
                }
                //抱歉，因为后台处理的原因，最后一个字符不应该是|，所以我要处理一下~~
                temp = titNum + '.' + title + 'A.' + ansA + 'B.' + ansB + 'C.' + ansC;
                if(i != num - 1){
                    temp = temp + '|';
                }
                submit =submit + temp;
                submitAns = submitAns + ans;
                temp = '';
                title = '';
                titNum = 0;
                ansA = '';
                ansB = '';
                ansC = '';
                ans = '';
            }
            //我很可怕的把数据处理完了，这是最可怕的事情把哈哈哈哈 submit是题目，submitAns是答案串 name是听力材料名称 remark 是听力材料介绍 text是听力材料原文....
            var http = new XMLHttpRequest();//罪恶的开始
            http.onreadystatechange=function() {
                if (http.readyState==4 && http.status==200) {
                    var result = JSON.parse(http.responseText);
                    var msg = result['msg']
                    if(msg == 'success'){
                        layer.msg('添加成功，影响了1条(这不是废话吗...)');
                        setTimeout(function () {
                            location.reload();
                        },1000);
                    }else{
                        layer.msg('因为玄学原因，添加失败，影响了0条(这不是废话吗...)')
                    }
                }
            }
            http.open("POST","handle.php?t="+Math.random(),true);
            http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            http.send('name=' + name + '&remark=' +remark + '&text=' + text + '&title='+submit + '&answer='+submitAns + '&num=' + num + '&handle=add');
            return false;
        })
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