<div class="view">
   <form action="" method="post">
    <?php
        session_start();

        if (isset($_SESSION['view'])) {
            $_SESSION['view']+=1;
        }
        else {
            $_SESSION['view']=1;
        }
        echo "<center><h1><input type='submit' value='🔁' name='rp'>viewers = ". $_SESSION['view']."</h1>";
        echo "<hr color= navajowhite size=5>";
        date_default_timezone_set('Asia/Aden');
        echo "<h2>وقت اخر زيارة"."<br>". date("h:i:s")."</center><h2>";
        if (isset($_POST['rp'])) {
             session_destroy();
        }
        ?>
        </form>
</div>

<?php

    
    $connection = mysqli_connect("localhost", "root", "", "watches");

    if ($connection === false) {
        die("Error: Could not connect. ". mysqli_connect_error());
    }
        if (isset($_POST['submit_update'])) {

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
                    mysqli_query($connection, "UPDATE `table_watches` SET `Name` = '$name', `UserName`='$user_name', `Passwords`='$password', `Email` = '$email'");
                        $msseg = "<h2>✔️تم التعديل</h2>";
                        if (isset($_COOKIE["update_name"]) || isset($_COOKIE["update_username"])
                            || isset($_COOKIE["update_email"]) || isset($_COOKIE["update_password"])) 
                        {
                            unset($_COOKIE["update_name"]);
                            unset($_COOKIE["update_username"]);
                            unset($_COOKIE["update_email"]);
                            unset($_COOKIE["update_password"]);
                        }
                }
                        
    }
    $ok = "اصبح بامكانك الان تعديل كل بياناتك";
    mysqli_close($connection);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/stylehome1.css">
    <title> Update </title>
</head>
<body>
    <p style="text-align: center; font-size: 30px; color: rgba(255, 208, 0, 0.938); ">
            <marquee direction="lift" width="50%" > Welcome to Site AMA.Web </marquee>
    </p>
    <div class="create_new">
    <form action="" method="post">
        <table>
            <caption> Update Account </caption>
            <tr>
                <th colspan=2 class="a"><?php if(isset($msseg)){ unset($ok); echo $msseg; } elseif(isset($ok)){ echo $ok; } ?><?php if(isset($errors)){ if(!empty($errors)){foreach($errors as $msg){ echo $msg . "<br>"; } } } ?></th>
            </tr>
            <tr>
                <td>Name :<font color="red" >*</font><br><?php if(isset($em_frist_na)){echo $em_frist_na; }?><input type="text" name="name" value="<?php if(isset($_COOKIE["update_name"])) { echo $_COOKIE["update_name"]; } ?>"></td>
            </tr>
            <tr>
                <td>User Name :<font color="red" >*</font><br><?php if(isset($em_last_na)){echo $em_last_na; }?><input type="text" name="user_name" value="<?php if(isset($_COOKIE["update_username"])) { echo $_COOKIE["update_username"]; } ?>"></td>
            </tr>
            <tr>
                <td>Email :<font color="red" >*</font><br><?php if(isset($em_email)){echo $em_email; }?><input type="text" name="email" value="<?php if(isset($_COOKIE["update_email"])) { echo $_COOKIE["update_email"]; } ?>"></td>
            </tr>
            <tr>
                <td>password:<font color="red" >*</font><br><?php if(isset($em_password)){echo $em_password; }?><input type="password" name="password" value="<?php if(isset($_COOKIE["update_password"])) { echo $_COOKIE["update_password"]; } ?>"></td>
            </tr>
            <tr>
                <td class="boutton_create"><input type="Submit" value="Update" name="submit_update">
                <a href="create_account.php"><input type="button" value="cancel "></a></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>