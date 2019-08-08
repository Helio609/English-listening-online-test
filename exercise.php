<?php
$id = isset($_GET['id'])?$_GET['id']:null;
if($id == null){
    exit('骚年单单访问这个页面是没用的哈哈。');
}
require_once ('cron/dbs.class.php');
$conn = new DBS();
$conn->query('SET NAMES utf8');
$sql = "SELECT * FROM `exercise` WHERE id = $id";//终于要写点不一样的东西了.
if(($exercise = $conn ->query($sql)) != false){
$data = $exercise->fetch_assoc();
$num = $data['num'];
$refer = $data['refer'];
$exestr = $data['text'];
$exearray = array();
$count = 0;
$charline = '';
for($i = 0;$i < strlen($exestr);$i++) {
    if($exestr[$i] != '|'){
        $charline .= $exestr[$i];
    }else{
        $exearray[$count] = $charline;
        $charline = '';
        $count++;
    }
}
$exearray[$count] = $charline;
$charline = '';
$count = 0;
//题目处理完毕.....
//进行答案处理
$answer = $data['answer'];
//不管了，进行一下简单的答案处理。
$exerciseMap = array(array());

for($i = 0 ; $i < $num ; $i++){
    $j = 0;
    for(; $j < strlen($exearray[$i]);$j++){
        $charline .= $exearray[$i][$j];
        if(($exearray[$i][$j+1] == "A" || $exearray[$i][$j+1] == "B") && $exearray[$i][$j+2] == "."){
            $exerciseMap[$i][$count] = $charline;
            $charline ='';
            $count++;
        }elseif ($exearray[$i][$j+1] == "C" && $exearray[$i][$j+2] == "."){
            $exerciseMap[$i][$count] = $charline;
            $charline ='';
            $count++;
            break;
        }
    }
    $exerciseMap[$i][$count] = substr($exearray[$i],$j+1,strlen($exearray[$i]));
    $charline = '';
    $count = 0;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>听力练习-崇仁中学英语听力系统</title>
    <link rel="stylesheet" href="./css/layui.css">
</head>
<body style="background-color: #F2F2F2">

<ul class="layui-nav" lay-filter="">
    <li class="layui-nav-item"><a href="index.php">首页</a></li>
    <li class="layui-nav-item layui-this"><a href="#">检测</a></li>
    <li class="layui-nav-item"><a href="about.php">关于</a></li>
</ul>

<div class="layui-container" style="text-align: center;">
    <div class="layui-row">
        <div class="layui-col-md12">
            <audio src="<?php echo 'upload/'.$refer;?>" controls="controls">
                不会吧，用这么古老的浏览器，您的浏览器不支持html5播放哦，请使用火狐或者谷歌浏览器(其实360浏览器也不错....)
            </audio>
        </div>
    </div>
</div>

<div class="layui-form layui-container">
    <?php
    //开始输出答案
    for($i = 0 ; $i < $num ; $i++){
        echo sprintf('<div class="layui-form-item layui-row">
            <div class="layui-card layui-col-md12">
                <div class="layui-card-header" style="font-size: 20px;height: auto;line-height: normal;">%s</div>
                    <div class="layui-card-body">
                        <ul>
                            <li>
                                <input type="radio" name="answer%s" value="A" title="%s"/>
                                <input type="radio" name="answer%s" value="B" title="%s"/>
                                <input type="radio" name="answer%s" value="C" title="%s"/>
                            </li>
                        </ul>
                    </div>
        </div>
    </div>',$exerciseMap[$i][0],$i+1,$exerciseMap[$i][1],$i+1,$exerciseMap[$i][2],$i+1,$exerciseMap[$i][3]);
    }
    }else{
        exit('Somethings wrong!');
    }
    ?>
    <div class="layui-form-item layui-row" style="text-align: center">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="go">提交答案</button>
        </div>
    </div>
</div>

<script src="./layui.js"></script>
<?php
echo sprintf('
<script>
var id = %s;
</script>
',$id);
?>
<script>
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer
            ,form = layui.form;
        layer.msg('PC端请无视......因为懒得写的原因，强烈建议使用横屏浏览，否则CSS渲染会出现少量问题。')

        form.on('submit(go)',function (data) {
            var http = new XMLHttpRequest();
            http.onreadystatechange=function()
            {
                if (http.readyState==4 && http.status==200)
                {
                    var result =JSON.parse(http.responseText);
                    var num = result['num'];//得到题目数量
                    var full = result['full'];
                    var point = result['point'];
                    var answer = result['answer'];
                    var judge = new Array();
                    var str = 'answer';
                    var title = result['title'];
                    var titleMsg = '';
                    for(var i = 1 ; i <= num ; i++){
                        judge[i-1] =result[str + i];
                        if(judge[i-1] == true){
                            titleMsg = titleMsg + '<p style="text-align: center;font-size: 15px;color: #00fa0a">第' + i + '题: 答案: ' + answer[i-1] + ' 正确!</p></br>';
                        }else{
                            titleMsg = titleMsg + '<p style="text-align: center;font-size: 15px;color: #f20000;">第' + i + '题: 答案: ' + answer[i-1] + ' 错误!</p></br>';
                        }
                    }
                    if(point == full){
                        var msg = '哇，全部做对了，我没有什么好说的了！'
                    }else{
                        var msg = '嗯？还有错误哦，请点击查看答案页进行答案的校对！'
                    }
                    var displayAns = '';
                    for(var i = 1 ; i <= num ;i++){
                        displayAns = displayAns + answer[i-1];
                        if(i % 5 == 0){
                            displayAns = displayAns + ' ';
                        }
                    }
                    //judge存放每一题的答题情况.
                    //所有的东西都已经处理完成了 so easy！
                    layer.tab({
                        area: ['300px', '300px'],
                        tab: [{
                            title: '成绩',
                            content: '<p style="text-align: center;font-size: 20px;">总分:' + full + '分</br>您获得了' + point + '分。</p></br><p style="text-align: center;font-size: 20px;">'+msg+'</p>'
                        }, {
                            title: '查看答案',
                            content: '<p style="text-align: center;font-size: 20px;">听力的答案是</br>' + displayAns + '</p>' + titleMsg
                        }, {
                            title: '查看原文',
                            content: title
                        }]
                    });
                    layer.msg('笑哭~~~ 如果你关不掉这个弹窗的话，请横屏浏览，作者比较懒~懒懒的管~~~')
                }
            }
            http.open("POST","answer.php?t="+Math.random(),true);
            http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            http.send("data="+JSON.stringify(data.field)+"&id="+id);
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
