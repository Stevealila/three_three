<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP BLOG</title>
</head>
<body>
    
<header>
    
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php if(isset($_SESSION['id'])){
                echo('
                    <div class="avatar-container">
                        <img style="height: 50%;border-radius: 90%;margin: 0 5rem;" src="'.$_SESSION['photo'].'" alt="User Photo">
                        <p>'.$_SESSION['user'].'</p>
                        <span style="padding: 0 1rem;"><a href="user_dashboard.php">Dashboard</a></span>
                        <span style="padding: 0 1rem;"><a href="blog_create.php">New Blog</a></span>
                    </div>
                    <li><a href="user_logout.php">Logout</a></li>
                ');
            }else {
                echo('
                    <li>
                        <a href="user_register.php">Register</a></li>
                    <li>
                        <a href="user_login.php">Login</a>
                    </li>
                ');
            }
            ?>
        </ul>
    </nav>
</header>

<div style="
    width: 90vw; 
    height: 90vh; 
    margin: 3rem auto; 
    padding: 0.5rem; 
    background-color: #fff; 
    border-radius: 10% 49% 10% 45%;
    box-shadow: 0px 2px 0px #a9bfe7;
    z-index: -1000;
    position: absolute;
    top: 0;
">

</div>