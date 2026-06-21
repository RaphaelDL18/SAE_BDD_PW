<?php
    session_start();
    session_destroy();
    header('Location: liste.php');
    exit;
?>