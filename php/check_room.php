<!DOCTYPE html >
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>客房信息列表</title>
    <link rel="stylesheet" href="../css/page.css">
</head>

<body>
<!--客房信息列表-->
    <div class="clearfix admin_con_top">
        <h1 class="title">已有客房信息列表</h1>
        <?php
        include ('connect.php');
        $sql="select * from roomstatus";
        $query=mysqli_query($conn,$sql);
        $rowscount=mysqli_num_rows($query);
        ?>
        <p style="text-align: center;">共<span><?php echo $rowscount;?></span>条记录</p>
    </div>
        <table>
            <tr class="row">
                <th class="ttitle">房间号</th>
                <th class="ttitle">状态</th>
            </tr>
            <?php
            while($row = mysqli_fetch_assoc($query)) {
                $number = $row['房间号'];
                $status = $row['状态'];
                ?>
                <tr class="row">
                    <td class="tcontent"><?php echo $number;;?></td>
                    <td class="tcontent"><?php echo $status;;?></td><br/>
                </tr>
                <?php
            }
                    ?>
</body>
</html>

