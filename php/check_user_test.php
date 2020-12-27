<?php
include('connect.php');
$number=$_POST['number'];
$name=$_POST['name'];
?>
<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>用户注册信息列表</title>
</head>

<body class="check_news_body">
<!--注册用户信息列表-->
<div class="clearfix admin_con_top">
    <h2 class="fl">已有注册信息列表</h2>
</div>
<?php
if ($number!=""){
    $sql="select custmerinfo.* from custmerinfo,checkin where custmerinfo.身份证号=checkin.身份证号 and checkin.房间号 = '$number'";
}
if ($name!=""){
    $sql="select * from custmerinfo where 姓名 = '$name'";
}
$query=mysqli_query($conn,$sql);
if (!$query) {
    echo 'Error', mysqli_error($conn),'<br/>';
    exit();
}
$rowscount=mysqli_num_rows($query);
if($rowscount==0)
{
    echo '错误：不存在<a href="javascript:history.go(-1);">返回重试<a/>';
}else{
?>
<table class="table table-bordered table-hover">
    <tr>
        <th><input type="checkbox" name="" id="checkall" value="" /></th>
        <th>身份证号</th>
        <th>姓名</th>
        <th>性别</th>
        <th>电话号</th>
        <th>服务的员工编号</th>
    </tr>
    <?php
    while($row = mysqli_fetch_assoc($query)) {
        $card = $row['身份证号'];
        $name = $row['姓名'];
        $gender = $row['性别'];
        $tel = $row['电话号'];
        $no = $row['服务的员工编号'];
        ?>
        <tr>
            <td><input type="checkbox" name="" id="" value="" class="sel_btn"/></td>
            <td><?php echo $card;?></td>
            <td><?php echo $name;?></td>
            <td><?php echo $gender;?></td>
            <td><?php echo $tel;?></td>
            <td><?php echo $no;?></td>
        </tr>
        <?php
    }
    }
    ?>
</table>
</body>
</html>