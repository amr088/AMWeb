<?php

    
    $connection = mysqli_connect("localhost", "root", "", "watches");
    
    if ($connection === false) {
        die("Error: Could not connect. ". mysqli_connect_error());
    }
    if (isset($_POST['submit_create'])) {
        
        $name = $_POST['name'];
        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if (empty($_POST['name'])) {
            $em_frist_na = "<span classe='error'>Frist Name field is required</span>";
        }
        elseif (empty($_POST['user_name'])) {
            $em_last_na = "<span classe='error'>Last Name field is required</span>";
        }
        elseif (empty($_POST['email'])) {
            $em_email = "<span classe='error'>Email field is required</span>";
        }
        elseif (empty($_POST['password'])) {
            $em_password = "<span classe='error'>password field is required</span>";
        }
        else { 
            
            $stm="SELECT * FROM table_watches WHERE Email ='$email'"; 
            $q=$connection->prepare($stm);
            $q->execute();
            $data=$q->fetch();
            if($data){ 
                    $errors[]="<h2>البريد الاكتروني موجود بالفعل <br><a href='login.php' >الانتقال الى صفحة تسجيل الدخول</a></h2>"; 
                }
                else {
                    
                    $sql = "INSERT INTO table_watches (`Name`, UserName, Email, Passwords) VALUES ('$name', '$user_name', '$email', '$password')";
                    if (mysqli_query($connection, $sql)) {
                        $msseg = "<h1>تم انشاء الحساب</h1>";
                    }else {
                        echo "ERROR: Could not able to execute $sql " . mysqli_error($connection);
                    }
                }
                
                
            }
        }
    if (isset($_POST['update'])) {
            $name = $_POST['name'];
            $user_name = $_POST['user_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $stm ="SELECT * FROM table_watches where UserName = '$user_name' and Passwords = '$password' or Email = '$email' ";
            $q=$connection->prepare($stm);
            $q->execute();
            $data=$q->fetch();
            if($data){
                setcookie ("update_name",$_POST["name"],time()+ 3600*24*7);
                setcookie ("update_username",$_POST["user_name"],time()+ 3600*24*7);
                setcookie ("update_email",$_POST["email"],time()+ 3600*24*7);
                setcookie ("update_password",$_POST["password"],time()+ 3600*24*7);
                header('location: update.php');
            }
            else{
                $ro = "<h2>اسم المستخدم او البريد الاكتروني او كلمة المرور خطاء</h2>";
            }
        }
        if (isset($_POST['delete'])) {
            $name = $_POST['name'];
            $user_name = $_POST['user_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $stm ="SELECT * FROM table_watches where UserName = '$user_name' and Passwords = '$password' or Email = '$email' ";
            $q=$connection->prepare($stm);
            $q->execute();
            $data=$q->fetch();
            if($data){
                unset($q);
                if (mysqli_query($connection,"DELETE FROM `table_watches` where `Email` ='$_POST[email]'")) {
                   $sh_de = "<h1>تم الحذف</h1>";
                }
            }
            else{
                $ro = "<h1>❌عذراً هذا الحساب غير موجود</h1>";
            }
    }

    mysqli_close($connection);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/stylehome1.css">
        <title> Create Account </title>
        
    </head>
    <body>
        <form action="" method="post">    
    </p>
    <div class="create_new">
        <form class='form_create_new' action='' method='post' >
        <table>
            <caption> Create Account </caption>
            <tr>
                <th colspan=2 class="a"><?php if(isset($sh_de)){ echo $sh_de; } elseif(isset($ro)){echo $ro; }?><?php if(isset($msseg)){ echo "$msseg<br><h6><a href='login.php'> الانتقال الى صفحة تسجيل الدخول</a></h6>"; } if(isset($errors)){ if(!empty($errors)){foreach($errors as $msg){ echo $msg . "<br>"; } } } ?></th>
            </tr>
            <tr>
                <td>Name :<font color="red" >*</font><br><?php if(isset($em_frist_na)){echo $em_frist_na; }?><input type="text" name="name" ></td>
            </tr>
            <tr>
                <td>User Name :<font color="red" >*</font><br><?php if(isset($em_last_na)){echo $em_last_na; }?><input type="text" name="user_name" ></td>
            </tr>
            <tr>
                <td>Email :<font color="red" >*</font><br><?php if(isset($em_email)){echo $em_email; }?><input type="text" name="email" ></td>
            </tr>
            <tr>
                <td>password:<font color="red" >*</font><br><?php if(isset($em_password)){echo $em_password; }?><input type="password" name="password" ></td>
            </tr>
            <tr>
                <td class="boutton_create">
                    <input type="Submit" value="Create " name="submit_create">
                    <input type="submit" value="Update" name="update">
                    <input type="submit" value="delete" name="delete">
                    <a href="../../index.php"><input type="button" value="cancel "></a>
                </td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>