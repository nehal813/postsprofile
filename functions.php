<?php
require 'connection.php';

function checklog(){

    if(empty($_SESSION['info'])){

        header("location:login.php");
        die;
    }
}