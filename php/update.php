<html>
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="../css/page.css">
</head>
<body>
    <h1 class="title">客房修改</h1>
<?php
    include 'connect.php';
    $NoErr ="";$KeyErr ="";
    $No=$Key=$RoomNo=$Price=$Status=$Type=$RoomNoErr="";
    $tbool=true;
    $startre=false;
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $startre=true;
        if (empty($_POST["No"]))
        {
            $NoErr = "必填";
            $tbool=false;
        }
        else    
        {
            $No = test_input($_POST["No"]);
        }

        if (empty($_POST["Key"]))
        {
            $KeyErr = "必填";
            $tbool=false;
        }
        else    
        {
            $Key = test_input($_POST["Key"]);
        }

        if (empty($_POST["RoomNo"]))
        {
            $RoomNoErr = "必填";
            $tbool=false;
        }
        else    
        {
            $RoomNo = test_input($_POST["RoomNo"]);
        }
        $Price = test_input($_POST["Price"]);
        $Type = test_input($_POST["Type"]);
        $Status = test_input($_POST["Status"]);
    }

    if($tbool && $startre){
        //修改房间价格
        $sql_query="select 密码 from managerinfo where 工作编号 ='".$No."'";
        $sql=$conn->query($sql_query);
        $info=mysqli_fetch_assoc($sql);
        if($info["密码"]==$Key){
            //有权限修改
            if (!empty($_POST["Price"])){  //修改房间价格
                $sql_query="update roominfo set 价格='".$Price."' where 房间号='".$RoomNo."'";
                $conn->query($sql_query);
            }
            if (!empty($_POST["Type"])){  //修改房间类型
                $sql_query="update roominfo set 类型='".$Type."' where 房间号='".$RoomNo."'";
                $info=$conn->query($sql_query);
            }
            if (!empty($_POST["Status"])){  //修改房间状态
                $sql_query="update roomstatus set 状态='".$Status."' where 房间号='".$RoomNo."'";
                $conn->query($sql_query);
            }
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
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
    <div class="block">
        <label class="font">工作编号:</label><input type="text" name="No">
        <span class="error" style="color:brown"><?php echo $NoErr;?></span>
    </div>
    <div class="block">
        <label class="font">密码:</label><input type="text" name="Key">
        <span class="error" style="color:brown"><?php echo $KeyErr;?></span>
    </div>
    <div class="block">
        <label class="font">房间号:</label><input type="text" name="RoomNo">
        <span class="error" style="color:brown"><?php echo $RoomNoErr;?></span>
    </div>
    <div class="block">
        <label class="font">价格:</label><input type="text" name="Price">
        <span class="error" style="color:brown"></span>
    </div>
    <div class="block">
        <label class="font">类型:</label><input type="text" name="Type">
        <span class="error" style="color:brown"></span>
    </div>
    <div class="block">
        <label class="font">状态:</label><input type="text" name="Status">
        <span class="error" style="color:brown"></span>
    </div>
    <div class="block">
        <input type="submit" name="submit" value="Update" style="width: 100px;margin-left:20px">
    </div>
</form>
</div>
</header>
</body>
