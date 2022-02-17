<?php 
include("header.php");

require_once("blog_functions.php");
create_blog();

?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <label for="title">Blog Title:</label>
    <input type="text" name="title" id="title" required>
    <label for="cover_image">Cover Image:</label>
    <input type="file" name="cover_image" id="cover_image">
    <label for="blog_body">Blog Body:</label>
    <textarea name="blog_body" cols="30" rows="10"></textarea>
    <button name="create_blog">Create</button>
</form>

<?php include("footer.php"); ?>