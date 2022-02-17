<?php 
include("header.php");

require_once("database_connection.php");

global $conn;

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
    $pwd = mysqli_real_escape_string($conn, htmlspecialchars($_POST['pwd']));

    //VALIDATE USER
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0) {

        $row = mysqli_fetch_assoc($check);

        $is_verified = password_verify($pwd, $row['pwd']);

        if($is_verified){

            session_start();

            $_SESSION['id'] = $row['user_id'];
            $_SESSION['user'] = $row['username'];
            $_SESSION['photo'] = $row['user_photo'];

            header('Location: index.php?login=success');
            exit;
        }else {
            echo('<script>alert("You cannot log in!"); window.location.href="index.php";</script>');
            exit;
        }
    }

}
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <label for="pwd">Password:</label>
    <input type="password" name="pwd" id="pwd" required>
    <button name="login">Login</button>
</form>

<?php include("footer.php"); ?>