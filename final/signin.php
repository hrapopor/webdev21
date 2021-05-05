<?php
session_start();

include_once 'header.php';
require_once 'login.php';
include_once 'functions.php';

if (isset ($_POST['submit'])) {
    if (empty($_POST['username'])||(empty($_POST['password']))) {
        echo '<p>Please fill in fields<p>'; 
    } else {
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);
        $username = sanitizeMySQL($conn, $_POST['username']);
        $password = sanitizeMySQL($conn, $_POST['password']);
        $salt1 = "D3%jv";
        $salt2 = "bv#s";
        $password = hash('ripemd128', "$salt1$password$salt2");
        $query = "SELECT username FROM user WHERE username='$username' AND `password`='$password'";
        $result = $conn->query($query);
        if(!$result) die ($conn->error);
        $rows = $result->num_rows;
        if ($rows==1) {
            $row =$result->fetch_assoc();
            $_SESSION['username']=$row['username'];
            header("Location: index.php");
        }
        else {
           echo "<p>Invalid username and password<p>";
        }

    }

}


?>
<fieldset style="width:30%">
<legend>Log-in</legend>
<form method="POST" action="">
    Username:<br><input type="text" name="username" size="40"><br>
    Password:<br><input type="password" name="password" size="40"><br>
<input type="submit" name="submit" value="Log In">
</form>
</fieldset>

<?php
include_once 'footer.php';
?>