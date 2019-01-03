<?php
require_once('koneksi.php');
if($_SERVER['REQUEST_METHOD']=='GET') {
    $id = $_GET['q'];
    $hapus = "DELETE FROM attendances WHERE id='$id'";
    if(mysqli_query($koneksi,$hapus)){
        header("Location: index.php");
    }
}
?>