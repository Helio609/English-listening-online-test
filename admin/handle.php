<?php
/**
 * Created by PhpStorm.
 * User: Lahore
 * Date: 2019/1/30
 * Time: 15:36
 */
require_once ('../cron/dbs.class.php');
$conn = new DBS();
$conn->query('SET NAMES utf8');
$handle = isset($_POST['handle']) ? $_POST['handle'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;
$msg = json_encode(array('msg' => 'error','handle'=>$handle,'id'=>$id));
if($handle == 'add'){
    //接受一堆的参数并且判断存在性
    //'name=' + name + '&remark=' +remark + '&text=' + text + '&title='+submit + '&answer='+submitAns + '&num=' + num + '&handle=add'
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $remark = isset($_POST['remark']) ? $_POST['remark'] : null;
    $text = isset($_POST['text']) ? $_POST['text'] : null;
    $answer = isset($_POST['answer']) ? $_POST['answer'] : null;
    $num = isset($_POST['num']) ? $_POST['num'] : null;
    $refer = 'No refer yet';
    //获取一堆参数完成
    if(!$text){
        $text = '应该是懒得写，软件直接生成的......';
    }
    if($title && $name && $remark && $answer && $num){
        $sql = "INSERT INTO `exercise` (`num`, `text`, `title`, `answer`, `name`, `remark`, `refer`) VALUES ('$num', '$title', '$text', '$answer', '$name', '$remark', '$refer')";
        $result = $conn->query($sql);
        if($result){
            $msg = json_encode(array('msg' => 'success','handle'=>$handle));
        }
    }
}elseif($handle == 'delete'){
    if($id){
        $sql = 'DELETE FROM exercise WHERE id = '.$id;
        $result = $conn->query($sql);
        if($result){
            $msg = json_encode(array('msg' => 'success','handle'=>$handle,'id'=>$id));
        }
    }
}elseif($handle == 'edit'){

}
echo $msg;