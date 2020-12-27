<!DOCTYPE html >
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>客房信息列表</title>
</head>

<body class="news_list_body">
<!--客房信息列表-->
<div class="staff_list">
    <div class="clearfix admin_con_top">
        <h2 class="fl">已有客房信息列表</h2>
        <?php
        include ('connect.php');
        $sql="select * from roomstatus where 1=1";
        $query=mysqli_query($conn,$sql);
        $rowscount=mysqli_num_rows($query);
        ?>
        <p class="fr">共<span><?php echo $rowscount;?></span>条记录</p>
    </div>
        <table class="table table-bordered table-hover">
            <tr>
                <th><input type="checkbox" name="" id="checkall" value=""/></th>
                <th>房间号</th>
                <th>状态</th>
            </tr>
            <?php
            while($row = mysqli_fetch_assoc($query)) {
                $number = $row['房间号'];
                $status = $row['状态'];
                ?>
                <tr>
                    <td><input type="checkbox" name="" id="" value="" class="sel_btn"/></td>
                    <td><?php echo $number;;?></td>
                    <td><?php echo $status;;?></td><br/>
                </tr>
                <?php
            }
                    ?>
</body>
</html>

