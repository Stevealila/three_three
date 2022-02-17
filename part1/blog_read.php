<?php 
include("header.php");
require_once("blog_functions.php");

$row = read_one_blog();

?>

<section style="
    width: 70%; 
    margin: 8rem auto; 
    padding: 0.5rem; 
    background-color: #fff; 
    border-radius: 10% 49% 10% 45%;
    box-shadow: 0px 2px 0px #a9bfe7;
">
    <div style="width: 70%; margin: 2rem auto; text-align:center">
        <h1 style="margin: 1rem auto"><?php echo $row['title']?></h1>
    <p>Created at: 
        <span style="font-style: italic; padding: .5rem 0;">
            <?php echo $row['creation_date']?>
        </span>
    </p>
    <p>Author: 
        <span style="font-style: italic; padding: .5rem 0;">
            <?php echo $row['author']?>
        </span>
    </p>
    </div>
    <hr style="padding: 1px; width: 80%; margin: auto;">
    <div style="padding: 2rem; width: 70%; margin: auto;">
        <?php echo $row['blog_body']?>
    </div>
</section>

<?php include("footer.php") ?>