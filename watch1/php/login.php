<?php
    if (isset($_POST['login'])) {
        $user_name = $_POST['username'];
        $password = $_POST['password'];

        if (empty($_POST['username'])) {
            $err_username = "<span classe='error'>User Name field is required</span>";
        }
        elseif (empty($_POST['password'])) {
            $err_password = "<span classe='error'>Password field is required</span>";
        }
        else {
        
        $connection = mysqli_connect("localhost", "root", "","watches");
        $stm ="SELECT * FROM table_watches where UserName = '$user_name' and Passwords = '$password' ";
            $q=$connection->prepare($stm);
            $q->execute();
            $data=$q->fetch();
        
                    if($data){
                        if (!empty($_POST["rememberme"])) {
                            setcookie ("member_login",$_POST["username"],time()+ 3600*24*7);
                            setcookie ("member_password",$_POST["password"],time()+ 3600*24*7);
                        }
                        else {
                            if (isset($_COOKIE["member_login"])) {
                            setcookie ("member_login","");
                        }
                            if (isset($_COOKIE["member_password"])) {
                            setcookie ("member_password","");
                        }
                    }
                    header('location: ../../index.php'); 
        }
        else {
            $ro = "اسم المستخدم او كلمة المرور خاطئة";
        }
        mysqli_close($connection); 
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/stylehome1.css">
    <title> Login </title>
</head>
<body>
    <!-- <p style="text-align: center; font-size: 30px; color: rgba(255, 208, 0, 0.938); ">
        <marquee direction="lift" width="50%" > Welcome to Site AMA.Web </marquee>
    </p> -->
    <form class="form_create_new" action="" method="post">
    <div class="create_new">
    <table>
        <caption><h2> login </h2></caption>
        <tr>
            <th colspan=2><?php if(isset($ro)){echo $ro; }?></th>
        </tr>
        <tr>
            <td>User Name :<br><?php if(isset($err_username)){ echo $err_username; } ?> <input type="text" name="username" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>"></td>
        </tr>
        <tr>
            <td>Password :<br><?php if(isset($err_password)){ echo $err_password; } ?> <input type="password" name="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>"></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="rememberme" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> > Remember me</td>
        </tr>
        <tr>
            <td class="boutton_create"><input type="Submit" value="Login " name="login" >
            <a href="../../index.php"><input type="button" value="cancel "></a></td>
        </tr>
    </table>
    </form>
    </div>
</body>
</html>