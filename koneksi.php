<?php
 define('HOST','localhost');
 define('USER','root');
 define('PASS','');
 define('DB','chenwoo');
 // define('HOST','localhost');
 // define('USER','id7563689_revitaliz');
 // define('PASS','rahasia');
 // define('DB','id7563689_smartcontr');

 $koneksi = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
?>
