<?php

include '../config/database.php';

if(isset($_POST['simpan'])){

$nama_depan=$_POST['nama_depan'];

$nama_belakang=$_POST['nama_belakang'];

$tanggal=$_POST['tanggal_lahir'];

$email=$_POST['email'];

$password=password_hash(
"12345678",
PASSWORD_DEFAULT
);

mysqli_query(
$conn,
"INSERT INTO users(

nama_depan,
nama_belakang,
tanggal_lahir,
email,
password,
role

)

VALUES(

'$nama_depan',
'$nama_belakang',
'$tanggal',
'$email',
'$password',
'user'

)"
);

header("Location:users.php");

}
?>