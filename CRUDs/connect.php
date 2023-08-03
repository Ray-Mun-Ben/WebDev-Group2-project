<?php
$con=new mysqli('localhost', 'root','','nothing');
if(!$con){
    die(mysqli_error($con));
}
?>