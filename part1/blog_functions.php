<?php

require_once("database_connection.php");
require_once("validations.php");

function delete_blog() {
    global $conn;

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $blog_deleted = mysqli_query($conn, "DELETE FROM blogs WHERE blog_id = '$id'");

        if($blog_deleted) {
            echo('
            <script>
                alert(" Blog deleted successfully!");
                window.location.href = "user_dashboard.php";
            </script>
            ');
            exit;
        }else {
            echo('
            <script>
                alert("Something went wrong!");
                window.location.href = "user_dashboard.php";
            </script>
            ');
            exit;
        }

    }else {
        header("Location: index.php?redirect=noBlogId");
        exit;
    }
}



function update_blog(){
    global $conn;

    if(isset($_SESSION['id'])){

        if(isset($_POST['update_blog']) && isset($_GET['id'])){

            $title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['update_title']));
            $blog_body = mysqli_real_escape_string($conn, htmlspecialchars($_POST['blog_body']));
            $id = $_GET['id'];
        
            $cover_image = $_FILES['update_cover_image'];
        
            //extract image parts for easy saving
            $temp_location = $cover_image['tmp_name'];
            $photo_name = $cover_image['name'];
        
            $ext = explode('.', $photo_name);
            $extname = $ext[1];
        
            //VALIDATE BLOG
            
            //unauthorized image type?
            wrong_image_type($extname, "user_dashboard.php");
        
            //SAVE BLOG;
            $upload_directory = 'images/'.$photo_name;
            move_uploaded_file($temp_location, $upload_directory);
        
            $updated_blog = mysqli_query($conn, "UPDATE blogs SET 
            title = '$title', 
            cover_image = '$upload_directory', 
            blog_body = '$blog_body' 
            WHERE blog_id = '$id'");
        
            if($updated_blog) {
                echo('
                <script>
                    alert(" Blog updated successfully!");
                    window.location.href = "user_dashboard.php";
                </script>
                ');
                exit;
            }
        
        }

    }else {
        echo('
                <script>
                    alert("Permission denied!");
                    window.location.href = "index.php";
                </script>
            ');
        exit(); 
    }
}


function read_one_blog() {
    global $conn;

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $blog = mysqli_query($conn, "SELECT * FROM blogs WHERE blog_id = '$id'");

        if(mysqli_num_rows($blog) > 0) {
            return mysqli_fetch_array($blog);
        }

    }else {
        header("Location: index.php?redirect=noBlogId");
        exit;
    }
}


function read_all_blogs() {
    global $conn;

    $blogs = mysqli_query($conn, "SELECT * FROM blogs ORDER BY creation_date DESC");

    if(mysqli_num_rows($blogs) > 0) {
        while($row = mysqli_fetch_array($blogs)){
            echo('
                <article>
                    <h3>'.$row['title'].'</h3>
                    <img style=" width: 70%; max-height: 50%; margin: 1.1rem auto;" 
                    src="'.$row['cover_image'].'" alt="Cover Image">
                    <div style="text-align: center; padding: 0.5rem; margin: .5rem auto;">'.
                        htmlspecialchars_decode(substr($row['blog_body'], 0, 150))
                    .'...</div>
                    <div>
                        <a style="color: #f7f8fc" href="blog_read.php?id='.$row['blog_id'].'">
                            <button style="width: 7rem; height: 2rem;">Read more</button>
                        </a>
                    </div>
                </article>
            ');
        }
    }
}



function create_blog(){
    global $conn;

    if(isset($_SESSION['id'])){

        if(isset($_POST['create_blog'])){

            $title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title']));
            $blog_body = mysqli_real_escape_string($conn, htmlspecialchars($_POST['blog_body']));
            $creator_id = $_SESSION['id'];
            $author = $_SESSION['user'];
        
            $cover_image = $_FILES['cover_image'];
        
            //extract image parts for easy saving
            $temp_location = $cover_image['tmp_name'];
            $photo_name = $cover_image['name'];
        
            $ext = explode('.', $photo_name);
            $extname = $ext[1];
        
            //VALIDATE BLOG
        
            // title exists?
            $check = mysqli_query($conn, "SELECT * FROM blogs WHERE title='$title'");
        
            if(mysqli_num_rows($check) > 0) {
                echo("
                    <script>
                        alert('Title already exists');
                        window.location.href = 'blog_create.php';
                    </script>
                ");
                exit();
            }
            
            //unauthorized image type?
            wrong_image_type($extname, "blog_create.php");
        
            //SAVE BLOG;
            $upload_directory = 'images/'.$photo_name;
            move_uploaded_file($temp_location, $upload_directory);
        
            $new_blog = mysqli_query($conn, "INSERT INTO 
            blogs (creator_id, author, title, cover_image, blog_body) 
            VALUES ('$creator_id', '$author', '$title', '$upload_directory', '$blog_body') ");
        
            if($new_blog) {
                echo('
                <script>
                    alert(" Blog: '.$title.' created successfully!");
                    window.location.href = "user_dashboard.php";
                </script>
                ');
                exit;
            }
        
        }

    }else {
        echo('
                <script>
                    alert("Permission denied!");
                    window.location.href = "index.php";
                </script>
            ');
        exit(); 
    }
}