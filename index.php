<?php
require 'functions/functions.php';
session_start();
if (isset($_SESSION['id'])) {
    header("location:home.php");
}
session_destroy();
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Social Network</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <style>
        .container {
            margin: 40px auto;
            width: 400px;
        }

        .content {
            padding: 30px;
            background-color: white;
            box-shadow: 0 0 5px #4267b2;
        }
    </style>
</head>

<body>
    <h1>KTÜ Maksjdasjfezun Bilgi Sistemi</h1>
    <div class="container">
        <div class="tab">
            <button class="tablink active" onclick="openTab(event,'signin')" id="link1">Login</button>
            <button class="tablink" onclick="openTab(event,'signup')" id="link2">Kayıt Olun</button>
        </div>
        <div class="content">
            <div class="tabcontent" id="signin">
                <form method="post" onsubmit="return validateLogin()">
                    <label>Öğrenci Numarası<span>*</span></label><br>
                    <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="userid" id="loginuserid" maxlength="6">
                    <div class="required"></div>
                    <br>
                    <label>Şifre<span>*</span></label><br>
                    <input type="password" name="userpass" id="loginuserpass">
                    <div class="required"></div>
                    <br><br>
                    <input type="submit" value="Login" name="login">
                </form>
            </div>
            <div class="tabcontent" id="signup">
                <form method="post" onsubmit="return validateRegister()">
                    <!--Package One-->
                    <h2>Kayıt yapmak için lütfen bilgilerinizi giriniz</h2>
                    <hr>
                    <!--First Name-->
                    <label>Isim Soyisim<span>*</span></label><br>
                    <input type="text" name="username" id="regusername">
                    <div class="required"></div>
                    <br>
                    <!--Nickname-->
                    <label>Öğrenci Numarası<span>*</span></label><br>
                    <input type="number" maxlength="6" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="userid" id="reguserid">
                    <div class="required"></div>
                    <br>
                    <!--Password-->
                    <label>Şifre<span>*</span></label><br>
                    <input type="password" name="userpass" id="reguserpass">
                    <div class="required"></div>
                    <br>
                    <!--Confirm Password-->
                    <label>Şifre Tekrar<span>*</span></label><br>
                    <input type="password" name="userpassconfirm" id="reguserpassconfirm">
                    <div class="required"></div>
                    <br>
                    <!--Email-->
                    <label>Email<span>*</span></label><br>
                    <input type="text" name="useremail" id="reguseremail">
                    <div class="required"></div>
                    <br>
                    <!--Birth Date-->
                    Doğum Tarihi<span>*</span><br>
                    <select name="selectday">
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <select name="selectmonth">
                        <?php
                        echo '<option value="1">January</option>';
                        echo '<option value="2">February</option>';
                        echo '<option value="3">March</option>';
                        echo '<option value="4">April</option>';
                        echo '<option value="5">May</option>';
                        echo '<option value="6">June</option>';
                        echo '<option value="7">July</option>';
                        echo '<option value="8">August</option>';
                        echo '<option value="9">September</option>';
                        echo '<option value="10">October</option>';
                        echo '<option value="11">Novemeber</option>';
                        echo '<option value="12">December</option>';
                        ?>
                    </select>
                    <select name="selectyear">
                        <?php
                        for ($i = 2017; $i >= 1900; $i--) {
                            if ($i == 1996) {
                                echo '<option value="' . $i . '" selected>' . $i . '</option>';
                            }
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <br><br>
                    <!--Gender-->
                    <input type="radio" name="usergender" value="M" id="malegender" class="usergender">
                    <label>Erkek</label>
                    <input type="radio" name="usergender" value="F" id="femalegender" class="usergender">
                    <label>Kadın</label>
                    <div class="required"></div>
                    <br><br>
                    <input type="submit" value="Hesap Oluştur" name="register">
                </form>
            </div>
        </div>
    </div>
    <script src="resources/js/main.js"></script>
</body>

</html>

<?php
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // A form is posted
    if (isset($_POST['login'])) { // Login process
        $id = $_POST['userid'];
        $userpass = md5($_POST['userpass']);
        $query = mysqli_query($conn, "SELECT * FROM students WHERE id = '$id' AND password = '$userpass'");
        if ($query) {
            if (mysqli_num_rows($query) == 1) {
                $row = mysqli_fetch_assoc($query);
                $_SESSION['id'] = $row['id'];
                $_SESSION['user_name'] = $row['nameSurname'];
                header("location:home.php");
            } else {
                ?> <script>
                    document.getElementsByClassName("required")[0].innerHTML = "Kullanıcı bulunamadı.";
                    document.getElementsByClassName("required")[1].innerHTML = "Kullanıcı bulunamadı.";
                </script> <?php
                                        }
                                    } else {
                                        echo mysqli_error($conn);
                                    }
                                }
                                if (isset($_POST['register'])) { // Register process
                                    // Retrieve Data
                                    $username = $_POST['username'];
                                    $userid = $_POST['userid'];
                                    $userpassword = md5($_POST['userpass']);
                                    $useremail = $_POST['useremail'];
                                    $userbirthdate = $_POST['selectyear'] . '-' . $_POST['selectmonth'] . '-' . $_POST['selectday'];
                                    $usergender = $_POST['usergender'];

                                    // Check for Some Unique Constraints
                                    $query = mysqli_query($conn, "SELECT id, mail FROM students WHERE id = '$userid' OR mail = '$useremail'");
                                    if (mysqli_num_rows($query) > 0) {
                                        $row = mysqli_fetch_assoc($query);
                                        if ($userid == $row['id'] && !empty($userid)) {
                                            ?> <script>
                    document.getElementsByClassName("required")[4].innerHTML = "Bu öğrenci numarasında kullanıcı zaten kayıtlı";
                </script> <?php
                                        }
                                    }
                                    // Insert Data
                                    $sql = "INSERT INTO students(nameSurname, id, password, mail, gender)
                VALUES ('$username', '$userid', '$userpassword', '$useremail', '$usergender')";
                                    $query = mysqli_query($conn, $sql);
                                    if ($query) {
                                        $query = mysqli_query($conn, "SELECT id FROM students WHERE id = '$userid'");
                                        $row = mysqli_fetch_assoc($query);
                                        $_SESSION['id'] = $row['id'];
                                        header("location:home.php");
                                    }
                                }
                            }
                            ?>
