<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            session_start();
            $loginErr="";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                include 'connect.php';
                $id=$_POST['username'];
                $pwd=$_POST['password'];
                $sql_query="select * from admin where id='".$id."' and password = '".$pwd."'";
                $sql=$conn->query($sql_query);
                $info=mysqli_fetch_array($sql);
                if($info==false){
                    $loginErr = "账号或密码错误!";
                    echo "<script>window.alert('".$loginErr."');</script>";
                    echo "<h>Hello world</h>";
                }
                else{
                    $_SESSION['id']=$id;
                    $_SESSION['pwd']=$pwd;
                    header("location:index.php");
                }
            }
        ?>
    </body>
</html>