<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../login/index.php');
} else {
    $id_user = $_SESSION['id'];
    $nick = $_SESSION['nick'];
    $tipo = $_SESSION['tipo'];
}
?>