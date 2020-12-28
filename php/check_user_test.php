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
    <link rel="stylesheet" href="../css/page.css">
</head>

<body class="check_news_body">
<!--注册用户信息列表-->
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
<h1 class="title">用户注册信息列表</h1>
<table>
    <tr class="row">
        <th class="ttitle"></th>
        <th class="ttitle">身份证号</th>
        <th class="ttitle">姓名</th>
        <th class="ttitle">性别</th>
        <th class="ttitle">电话号</th>
        <th class="ttitle">服务的员工编号</th>
    </tr>
    <?php
    while($row = mysqli_fetch_assoc($query)) {
        $card = $row['身份证号'];
        $name = $row['姓名'];
        $gender = $row['性别'];
        $tel = $row['电话号'];
        $no = $row['服务的员工编号'];
        ?>
        <tr class="row">
            <td class="tcontent"></td>
            <td class="tcontent"><?php echo $card;?></td>
            <td class="tcontent"><?php echo $name;?></td>
            <td class="tcontent"><?php echo $gender;?></td>
            <td class="tcontent"><?php echo $tel;?></td>
            <td class="tcontent"><?php echo $no;?></td>
        </tr>
        <?php
    }
    }
    ?>
</table>
</body>
</html>