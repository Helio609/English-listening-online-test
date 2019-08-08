<?php
/**
 * Created by PhpStorm.
 * User: Lahore
 * Date: 2019/1/31
 * Time: 12:51
 * 用于接收听力材料......
 */
require_once ('../cron/dbs.class.php');
$conn = new DBS();
$id = isset($_POST['id'])?$_POST['id']:null;//获取绑定的id信息
$fileName = $_FILES["file"]["name"];
$return = array(
    'code' => $_FILES['file']['error']
    ,'msg' => 'error'
    ,'id' => $id
    ,'fileName' => $fileName
    ,'data' => array(
        'src' => 'error'
    ));
if(file_exists('./'.$fileName)){//特殊情况....不同或相同文件存在的情况下...我要把上传的文件改名
    $fileName = 'New' . $fileName;
}
if(move_uploaded_file($_FILES['file']['tmp_name'],'./'.$fileName)){
    $sql = "UPDATE `exercise` SET `refer` = '$fileName' WHERE `exercise`.`id` = $id";
    $conn ->query($sql);
    $return['code'] = 0;
    $return['msg'] = 'success';
    $return['data']['src'] = "upload/" . $_FILES["file"]["name"];
}
//finally
$return = json_encode($return,true);
echo $return;