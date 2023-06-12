<?php
    session_start();
    if(!isset($_SESSION["authToken"])){
        route('index');
    }
?>