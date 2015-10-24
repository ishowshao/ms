<?php
if (isset($_GET['p']) && $_GET['p'] === '123') {
    session_start();
    $_SESSION['login'] = true;
    header('Location: ../index.html');
}
