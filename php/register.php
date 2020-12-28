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
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="../css/page.css">
</head>
<body>
<h1 class="title">顾客登记</h1>
<?php
    $idErr = "";$nameErr ="";$sexErr="";$telephoneErr="";
    $employeeidErr="";
    $id=$name=$sex=$telephone=$employeeid="";
    $tbool=true;
    $startre=false;
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $startre=true;
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

        if (empty($_POST["sex"]))
        {
            $sexErr = "必填";
            $tbool=false;
        }
        else    
        {
            $sex = test_input($_POST["sex"]);
        }

        if (empty($_POST["telephone"]))
        {
            $telephoneErr = "必填";
            $tbool=false;
        }
        else    
        {
            $telephone = test_input($_POST["telephone"]);
        }

        if (empty($_POST["employeeid"]))
        {
            $employeeidErr = "必填";
            $tbool=false;
        }
        else    
        {
            $employeeid = test_input($_POST["employeeid"]);
        }
    }

    if($tbool && $startre){
        include 'connect.php';
        //首先看看是否已经存在顾客信息，如果存在，提示已登记,否则就插入新记录
        $sql_query="select * from custmerinfo where 身份证号 ='".$id."'";
        $sql=$conn->query($sql_query);
        $info=mysqli_fetch_array($sql);
        if($info==false){
            //并不存在这一顾客
            $sql_query="insert into custmerinfo values('".$id."','".$name."','".$sex."',
            '".$telephone."','".$employeeid."')";
            $conn->query($sql_query);
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
            <label class="font">身份证号:</label><input type="text" name="id">
            <span class="error" style="color:brown"><?php echo $idErr;?></span>
        </div>
        <div class="block">
            <label class="font">姓名:</label><input type="text" name="name">
            <span class="error" style="color:brown"><?php echo $nameErr;?></span>
        </div>
        <div class="block">
            <label class="font">性别:</label><input type="text" name="sex">
            <span class="error" style="color:brown"><?php echo $sexErr;?></span>
        </div>
        <div class="block">
            <label class="font">电话号码: </label><input type="text" name="telephone">
            <span class="error" style="color:brown"><?php echo $telephoneErr;?></span>
        </div>
        <div class="block">
            <label class="font">服务的员工编号: </label><input type="text" name="employeeid">
            <span class="error" style="color:brown"><?php echo $employeeidErr;?></span>
        </div>
        <div class="block">
            <input class="button" type="submit" name="submit" value="Insert"> 
        </div>
    </form>
</div>
</header>
</body>