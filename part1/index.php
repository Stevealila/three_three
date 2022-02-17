<?php 
include("header.php");
require_once("blog_functions.php");

?>

<main>
    <?php read_all_blogs(); ?>
</main>

<?php include("footer.php") ?>