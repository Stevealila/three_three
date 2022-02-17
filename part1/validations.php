<?php 

function wrong_image_type($extname, $redirect_path){

    $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');

    if(!in_array($extname, $allowed_extensions)){
        echo("
            <script>
                alert('Wrong photo type!');
                window.location.href = '".$redirect_path."';
            </script>
        ");
        exit();
    }

}

function passwords_not_matching($password1, $password2, $error_message, $redirect_path){
    if($password1 !== $password2){
        echo('
            <script>
                alert("'.$error_message.'");
                window.location.href = "'.$redirect_path.'";
            </script>
        ');
        exit(); 
    }
}
