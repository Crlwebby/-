<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            session_start();
            $loginErr="";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $server_name="localhost";
                $username="root";
                $password="";
                $dbname="hotel_management";
                $conn = new mysqli($server_name,$username,$password,$dbname);
            
                if ($conn->connect_error) {
                    die("连接失败: " . $conn->connect_error);
                } 
                $id=$_POST['username'];
                $pwd=$_POST['password'];
                $sql_query="select * from admin where id='".$id."' and password = '".$pwd."'";
                $sql=$conn->query($sql_query);
                $info=mysqli_fetch_array($sql);
                if($info==false){
                    $loginErr = "账号或密码错误!";
                    echo "<script>window.alert('".$loginErr."');window.location.href='../login.html';</script>";
                }
                else{
                    $_SESSION['userid']=$id;
                    $_SESSION['pwd']=$pwd;
                    header("location:../index.html");
                }
            }
        ?>
    </body>
</html>