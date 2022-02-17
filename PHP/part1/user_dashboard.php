<?php 
require("header.php");

require_once("database_connection.php");
require_once("validations.php");

global $conn;

if(isset($_SESSION['id'])){

    $user_id = $_SESSION['id'];

    // user blogs exist?
    $blogs = mysqli_query($conn, "SELECT * FROM blogs WHERE creator_id='$user_id'");

    if(mysqli_num_rows($blogs) > 0) {

        echo('
            <section style="
                height: 90vh; 
                text-align: center;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            ">
            
            <table style="
                width: 70%; 
            ">
            <thead style="background-color: #ccc;">
            <tr>
            <th>id</th>
            <th>Title</th>
            <th>Creation Date</th>
            <th>Actions</th>
            </tr>
            </thead>
            <tbody>
        ');

        while ($row = mysqli_fetch_assoc($blogs)){
            echo('
                <tr>
                    <td>'.$row['blog_id'].'</td>
                    <td>'.$row['title'].'</td>
                    <td>'.$row['creation_date'].'</td>
                    <td><a href="blog_update.php?id='.$row['blog_id'].'">Edit</a></td>
                    <td><a href="blog_delete.php?id='.$row['blog_id'].'">Del</a></td>
                </tr>
            ');
        }

            echo('
            </tbody>
                    </table>
                </section>
            ');
    } else {
        echo('
            <div style="
                height: 90vh; 
                text-align: center;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                
            ">
                <p style="font-style: italic; font-size: 1.5rem; margin: 2rem auto; ">You have not created any blogs</p>
                
                <button style="width: 9rem;">
                    <a style="color: #fff; font-weight: bold;" href="blog_create.php">Create now</a>
                </button>
            </div>
        ');
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
?>


<?php include("footer.php"); 