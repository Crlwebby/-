<?php
    session_start();
    $id = $pwd = "";
    if(isset($_SESSION['admin_id'])){
        $id=$_SESSION['admin_id'];
        $pwd=$_SESSION['pwd'];
    }
?>
<html>
<head>
	<title>Book Management System For DataBase Lab</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="../css/page.css">
</head>
<body>
<?php
    $RoomNoErr ="";$idErr ="";$nameErr ="";$OutTimeErr ="";$dayErr ="";
    $RoomNo=$id=$name=$OutTime=$day=$price=$No=$employeeid=$InTime=$account="";
    $num=0;
    $tbool=true;
    $startre=false;
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $startre=true;
        if (empty($_POST["RoomNo"]))
        {
            $RoomNoErr = "必填";
            $tbool=false;
        }
        else    
        {
            $RoomNo = test_input($_POST["RoomNo"]);
        }

        if (empty($_POST["id"]))
        {
            $idErr = "必填";
            $tbool=false;
        }
        else    
        {
            $id = test_input($_POST["id"]);
        }

        if (empty($_POST["name"]))
        {
            $nameErr = "必填";
            $tbool=false;
        }
        else    
        {
            $name = test_input($_POST["name"]);
        }

        if (empty($_POST["OutTime"]))
        {
            $OutTimeErr = "必填";
            $tbool=false;
        }
        else    
        {
            $OutTime = test_input($_POST["OutTime"]);
        }

        if (empty($_POST["day"]))
        {
            $dayErr = "必填";
            $tbool=false;
        }
        else    
        {
            $day = test_input($_POST["day"]);
        }
    }

    if($tbool && $startre){
        include 'connect.php';
        //首先看看是否已经存在顾客信息，如果存在，提示已登记,否则就插入新记录
        $sql_query="select * from checkout where 身份证号 ='".$id."'";
        $sql=$conn->query($sql_query);
        $info=mysqli_fetch_array($sql);
        if($info==false){
            //并不存在这一顾客
            //插入退房表
            $sql_query2="insert into checkout values('".$RoomNo."','".$id."','".$name."',
            '".$OutTime."','".$day."')";
            $conn->query($sql_query2);
            var_dump($sql_query2);
            $num=$num+1;
            $No=strval($num);
            //查询入住时间
            $sql_query3="select 入住时间 from checkin where 身份证号 ='".$id."'";
            $sql1=$conn->query($sql_query3);
            $info1=mysqli_fetch_assoc($sql1);
            $InTime=$info1["入住时间"];
            //查询员工编号
            $sql_query4="select 服务的员工编号 from custmerinfo where 身份证号 ='".$id."'";
            $sql2=$conn->query($sql_query4);
            $info2=mysqli_fetch_assoc($sql2);
            $employeeid=$info2["服务的员工编号"];
            //查询价格
            $sql_query5="select 价格 from roominfo where 房间号 ='".$RoomNo."'";
            $sql3=$conn->query($sql_query5);
            $info3=mysqli_fetch_assoc($sql3);
            $price=$info3["价格"];
            //将所有信息插入订单
            $account=strval(intval($price)*intval($day));
            var_dump($account);

            $sql_query1="insert into orderinfo values('".$No."','".$id."','".$name."','".$RoomNo."',
            '".$employeeid."','".$price."','".$InTime."','".$OutTime."','".$account."')";
            $conn->query($sql_query1);
            var_dump($sql_query1);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<header>
<div id="sinsert">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="block">
        <label class="font">房间号:</label><input type="text" name="RoomNo">
        <span class="error" style="color:brown"><?php echo $RoomNoErr;?></span>
    </div>
    <div class="block">
        <label class="font">身份证号:</label><input type="text" name="id">
        <span class="error" style="color:brown"><?php echo $idErr;?></span>
    </div>
    <div class="block">
        <label class="font">姓名:</label><input type="text" name="name">
        <span class="error" style="color:brown"><?php echo $nameErr;?></span>
    </div>
    <div class="block">
        <label class="font">退房时间:</label><input type="text" name="OutTime">
        <span class="error" style="color:brown"><?php echo $OutTimeErr;?></span>
    </div>
    <div class="block">
        <label class="font">天数:</label><input type="text" name="day">
        <span class="error" style="color:brown"><?php echo $dayErr;?></span>
    </div>
    <div class="block">
        <input type="submit" name="submit" value="Checkout">
    </div>
</form>
</div>
</header>
</body>

</div>
<div id="sinsert">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    订单编号: 
    <span class="error" style="color:brown"><?php echo $No;?></span>
    身份证号:
    <span class="error" style="color:brown"><?php echo $id;?></span>
    姓名:
    <span class="error" style="color:brown"><?php echo $name;?></span>
    房间号: 
    <span class="error" style="color:brown"><?php echo $OutTime;?></span>
    员工编号:
    <span class="error" style="color:brown"><?php echo $employeeid;?></span>
    价格:
    <span class="error" style="color:brown"><?php echo $price;?></span>
    入住时间: 
    <span class="error" style="color:brown"><?php echo $InTime;?></span>
    退房时间: 
    <span class="error" style="color:brown"><?php echo $OutTime;?></span>
    总金额: 
    <span class="error" style="color:brown"><?php echo $account;?></span>
</form>
</div>
