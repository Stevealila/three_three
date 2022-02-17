<?php 
include("header.php");

require_once("database_connection.php");
require_once("validations.php");


global $conn;

if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
    $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
    $pwd = mysqli_real_escape_string($conn, htmlspecialchars($_POST['pwd']));
    $pwd_conf = mysqli_real_escape_string($conn, htmlspecialchars($_POST['pwd_conf']));

    $user_photo = $_FILES['user_photo'];

    //dissect image parts for easy saving
    $temp_location = $user_photo['tmp_name'];
    $photo_name = $user_photo['name'];

    $ext = explode('.', $photo_name);
    $extname = $ext[1];

    //VALIDATE USER
    
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");

    if(mysqli_num_rows($check) > 0) {
        echo("
            <script>
                alert('username taken');
                window.location.href = 'user_register.php';
            </script>
        ");
        exit();
    }
    
    passwords_not_matching($pwd, $pwd_conf, 'Passwords not matching!', 'user_register.php');
    wrong_image_type($extname, "user_register.php");

    //SAVE USER;

    $upload_directory = 'images/'.$photo_name;
    move_uploaded_file($temp_location, $upload_directory);

    $hashPwd = password_hash($pwd, PASSWORD_BCRYPT);

    $new_user = mysqli_query($conn, "INSERT INTO users (username, email, pwd, user_photo) VALUES ('$username', '$email', '$hashPwd', '$upload_directory') ");

    if($new_user) {
        header('Location: user_login.php?register=success');
        exit;
    }

}


?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <label for="pwd">Password:</label>
    <input type="password" name="pwd" id="pwd" required>
    <label for="pwd_conf">Confirm Password:</label>
    <input type="password" name="pwd_conf" id="pwd_conf" required>
    <label for="user_photo">User Photo:</label>
    <input type="file" name="user_photo" id="user_photo">
    <button name="register">Register</button>
</form>

<?php include("footer.php"); ?>