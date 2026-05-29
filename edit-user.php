<?php

include '../config/database.php';

$id=$_POST['id'];

$nama_depan=$_POST['nama_depan'];

$nama_belakang=$_POST['nama_belakang'];

$tanggal=$_POST['tanggal_lahir'];

$email=$_POST['email'];

mysqli_query(
$conn,

"UPDATE users SET

nama_depan='$nama_depan',
nama_belakang='$nama_belakang',
tanggal_lahir='$tanggal',
email='$email'

WHERE id='$id'
"

);

header("Location:users.php");

?>