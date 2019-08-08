<?php
/**
 * Created by PhpStorm.
 * User: Lahore
 * Date: 2019/1/26
 * Time: 22:02
 * 只是一个后端程序，接受2个参数，一个参数是20题的答案拼接而成的json，另一个是听力材料对应的正确答案。使用POST方式传递。
 */
require_once ('cron/dbs.class.php');
$ansJson = isset($_POST['data'])?$_POST['data']:null;
$id = isset($_POST['id'])?$_POST['id']:null;
if($ansJson && $id) {
    $conn = new DBS();
    $conn->query('SET NAMES utf8');
    $sql = "SELECT * FROM `exercise` WHERE id = $id";//终于要写点不一样的东西了.
    if (($exercise = $conn->query($sql)) != false) {
        $data = $exercise->fetch_assoc();
        $answer = $data['answer'];
        $num = $data['num'];
        $title = $data['title'];
        $title = str_replace("|","~~~~假装有换行~~~~",$title);
        $userAnswer = json_decode($ansJson, true);
        $judge = array();
        $point = 0;
        for ($i = 1; $i <= $num; $i++) {
            $str = 'answer' . $i;
            $judge[$str] = False;
            if ($userAnswer[$str] == $answer[$i - 1]) {
                $judge[$str] = True;
                $point += 1.5;
            }
        }
        $judge['answer'] = $answer;
        $judge['point'] = $point;
        $judge['num'] = $num;
        $judge['full'] = $num * 1.5;
        $judge['title'] = $title;
        $result = json_encode($judge);
        echo $result;
    } else {
        exit("NO DATA");
    }
}