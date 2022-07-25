<?php
        $connection = mysqli_connect("localhost", "root", "", "watches");
        if (isset($_POST['add'])) { //هذا الشرط لايتم تنفيذ الاكواد  الى بعد الضغط على زر الارسال
            if (empty($_POST['name'])) {
                $em_name = "<span class='error'> Name field is required</span>";
            }
            elseif (empty($_POST['model'])) {//تقوم هذه الدالة بتحقق اذا كان فارغ
                $em_model = "<span class='error'> model field is required</span>";
            }
            elseif (empty($_POST['name_cm'])) {
                $em_cm = "<span class='error'> Name Company field is required</span>";
            }
            elseif (empty($_POST['made'])) {
                $em_made = "<span class='error'> made field is required</span>";
            }
            else{//اذا لم يكن فارغ سيتم تنفيذ الكواد
                $name = $_POST['name'];
                $model = $_POST['model'];
                $name_cm = $_POST['name_cm'];
                $made = $_POST['made'];
                //هذا الكود يقوم بالاضافة
                $sql =mysqli_query($connection, "INSERT INTO `add` VALUES ('$name', '$model', '$name_cm', '$made')");
                if ($sql) {
                    $ok = "✔️تمت الاضافة";
                }
            }
        }
?>
<?php
    // هذه الاكواد خاصة بالحذف
    if (isset($_POST['delete'])) {
        if (empty($_POST['name'])) {
            $em_name = "<span class='error'> Name field is required</span>";
        }
        elseif (empty($_POST['model'])) {
            $em_model = "<span class='error'> model field is required</span>";
        }
        else{
            if (mysqli_query($connection, "SELECT * FROM `add` WHERE `name`='$_POST[name]' and `model`='$_POST[model]'")) {
                $dele ="DELETE FROM `add` where `name`='$_POST[name]' and `model`='$_POST[model]'";
        if (mysqli_query($connection, $dele)) {
            $sh_de = "تم الحذف";
        }
    }else {
        $select_del = "لاتوجد هذه الساعة بالفعل";
    }
    
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> AM-Web </title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!------------------------------------------------ footer ------------------------------------------------------------->
    <footer id="footer">
        <!-- <img src="../img/foo.png" class="img_hr"> -->
        <div class="fo">
            <form action="" method="post">
            <table class="table" dir=rtl>
                <!-- <caption> بيانات الساعات </caption> -->
                <tr>
                    <th>اسم الساعة</th>
                    <th> الموديل </th>
                    <th> اسم الشركة </th>
                    <th> بلد المنشاء </th>
                </tr>
                <tr>
                    <td><input type="text" name="name" id=""></td>
                    <td><input type="text" name="model" id=""></td>
                    <td><input type="text" name="name_cm" id=""></td>
                    <td><input type="text" name="made" id=""></td>
                </tr>
                </table>
                    <h2>    
                    <?php if(isset($ok)){ echo $ok; } elseif(isset($sh_de)){ echo $sh_de; } 
                    elseif(isset($sh_er)){ echo $sh_er; } elseif(isset($em_name)){ echo $em_name; }
                    elseif(isset($em_model)){echo $em_model;} elseif(isset($em_cm)){ echo $em_cm; }
                    elseif(isset($em_made)){ echo $em_made; } elseif(isset($select_del)){ echo $select_del;} ?></h2>
                    <input type="submit" value="✔️عرض" name="show">
                    <span class="del"><input type="submit" value="❌ حذف " name="delete"></span>
                    <input type="submit" value="✔️إضافة" name="add">
                </form>
                <?php
                    if (isset($_POST['show'])) {
                        echo "<table class='table1' dir=rtl>
                        <tr>
                            <th>اسم الساعة</th>
                            <th> الموديل </th>
                            <th> اسم الشركة </th>
                            <th> بلد المنشاء </th>
                        </tr>";
                        $query = mysqli_query($connection, "SELECT * FROM `add`");
                    while ($fetch = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td><?php echo $fetch['name'] ?></td>
                        <td><?php echo $fetch['model'] ?></td>
                        <td><?php echo $fetch['name_cm'] ?></td>
                        <td><?php echo $fetch['made'] ?></td>
                    </tr>
                <?php
                    }}
                    echo " </table>";
                ?>
            
           
        </div>
        <ul class="footer1">
            <li id="home1" class="foot1"><a href="#top" class="active1"> HOME </a></li>
            <li id="men1" class="foot1"><a href="#Men"> MEN </a></li>
            <li id="womens1" class="foot1"><a href="#womens"> WOMENS </a></li>
            <li id="boys1" class="foot1"><a href="#boys"> BOYS </a></li>
            <li id="girls1" class="foot1"><a href="#girls"> GIRLS </a></li>
            
    </footer>
    <div class="Rights">
        <p>© 2022 All Rights Reserved.by AM-Web </p>
    </div>
</body>
</html>
<?php mysqli_close($connection); ?>
