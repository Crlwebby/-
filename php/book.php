<?php
include 'connect.php';
$card = $_POST['card'];
$number = $_POST['number'];
$name = $_POST['name'];
$time = $_POST['time'];
if(empty($card)||!empty($number)||!empty($name)||!empty($time)){
    echo '请将数据添加完整<br>';
    echo '<a href="javascript:history.go(-1);">返回重试<a/>';
    exit(0);
}
$che=mysqli_query($conn,"select 状态 from roomstatus where number = '$number' and 状态 = '已入住'");
if (mysqli_fetch_array($che)){
    echo '错误：房间号',$number,'已经存在<a href="javascript:history.go(-1);">返回重试<a/>';
}
$sql="INSERT INTO checkin(房间号,身份证号,姓名,入住时间) VALUES ('$number','$card','$name','$time')";
$sql1="INSERT INTO roomstatus(状态) VALUES ('已入住')";
$res1=mysqli_query($conn,$sql1);
$res = mysqli_query($conn, $sql);
if ($res1){
    echo '添加失败：',mysqli_error($conn),'<br/>';}
if ($res){
    exit ('注册成功，点击此处<br/><a href="index.html">返回功能表</a>');
}else{
    echo '添加失败：',mysqli_error($conn),'<br/>';
    echo '点击重试<a href="javascript:history.go(-1);">返回重试<a/>';
}

