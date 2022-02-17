<?php 
include("header.php");

require_once("blog_functions.php");
update_blog();

$row = read_one_blog();

?>


<form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $row['blog_id']; ?>" method="post" enctype="multipart/form-data">
    <label for="title">Blog Title:</label>
    <input type="text" name="update_title" value="<?php echo $row['title']; ?>" id="title">
    <label for="cover_image">Cover Image:</label>
    <input type="file" name="update_cover_image" value="<?php echo $row['cover_image']; ?>" id="cover_image">
    <label for="blog_body">Blog Body:</label>
    <textarea name="blog_body" id="blog_body" cols="30" rows="10"><?php echo $row['blog_body']; ?></textarea>
    <button name="update_blog">Update</button>
</form>

<?php include("footer.php"); ?>