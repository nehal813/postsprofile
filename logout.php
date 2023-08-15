<?php require 'functions.php';
include ('header.php');

session_destroy();

session_unset();
header("location:login.php");
