<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "plaza";

    try{
        //$conn = new mysqli($server,$username,$password,$database);
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    }catch(PDOException $e){
        die('Connected failed'.$e->getMessage());
    }

?>