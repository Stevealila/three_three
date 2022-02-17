<?php

$conn = mysqli_connect("<ENTER SERVERNAME>", "<ENTER DATABASE USER>", "<ENTER DATABASE USER PASSWORD>", "<ENTER DATABASE NAME>");

if(!$conn){
    die("Could not connect to the database: " . mysqli_connect_error());
}