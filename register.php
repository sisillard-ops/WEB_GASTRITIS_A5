<?php
include 'config/database.php';

$error="";

if(isset($_POST['register'])){

$nama_depan=trim($_POST['nama_depan']);
$nama_belakang=trim($_POST['nama_belakang']);
$tanggal_lahir=$_POST['tanggal_lahir'];
$email=trim($_POST['email']);

$password=$_POST['password'];
$konfirmasi=$_POST['konfirmasi'];

if(strlen($password)<8){

$error="Password minimal 8 karakter";

}

elseif($password!=$konfirmasi){

$error="Konfirmasi password tidak cocok";

}

else{

$cek="SELECT id FROM users WHERE email=?";

$stmt=mysqli_prepare(
$conn,
$cek
);

mysqli_stmt_bind_param(
$stmt,
"s",
$email
);

mysqli_stmt_execute(
$stmt
);

$hasil=mysqli_stmt_get_result(
$stmt
);

if(mysqli_num_rows($hasil)>0){

$error="Email sudah digunakan";

}else{

$hash=password_hash(
$password,
PASSWORD_DEFAULT
);

$query="
INSERT INTO users
(
nama_depan,
nama_belakang,
tanggal_lahir,
email,
password,
role,
is_first_login
)

VALUES
(
?,
?,
?,
?,
?,
'user',
0
)
";

$stmt=mysqli_prepare(
$conn,
$query
);

mysqli_stmt_bind_param(
$stmt,
"sssss",
$nama_depan,
$nama_belakang,
$tanggal_lahir,
$email,
$hash
);

mysqli_stmt_execute(
$stmt
);

header(
"Location:login.php"
);

exit;

}

}

}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta
name="viewport"
content="width=device-width,initial-scale=1">

<title>Register CERNA</title>

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins;
}

body{

min-height:100vh;

display:flex;
justify-content:center;
align-items:center;

padding:30px;

background:
linear-gradient(
120deg,
#1d0800,
#3a1600,
#5b2300
);

}

.container{

width:100%;
max-width:470px;

background:#f9f5ef;

border-radius:25px;

overflow:hidden;

box-shadow:
0 15px 50px rgba(
0,
0,
0,
.35
);

}

.header{

padding:35px;

text-align:center;

color:white;

background:
linear-gradient(
90deg,
#2a0e00,
#592300
);

}

.logo{

width:80px;
height:80px;

margin:auto;
margin-bottom:15px;

}

.logo img{

width:100%;
height:100%;
object-fit:cover;

border-radius:20px;

}

.tabs{

display:flex;
}

.tabs a{

flex:1;

padding:16px;

text-decoration:none;

text-align:center;

font-weight:600;

}

.login-tab{

background:#5d2f17;
color:#d6b8a0;

}

.register-tab{

background:#d4a038;
color:black;

}

.content{

padding:35px;
}

.row{

display:flex;
gap:15px;
}

.input-box{

margin-bottom:18px;
width:100%;
}

.input-box label{

display:block;

margin-bottom:8px;

font-size:13px;
font-weight:600;

}

.input-box input{

width:100%;

padding:14px;

border-radius:10px;

border:1px solid #ddd;

font-size:14px;

}

.input-box input::placeholder{

color:#aaa;

}

.input-box input:focus{

outline:none;

border-color:#d69028;

box-shadow:
0 0 10px rgba(
214,
144,
40,
.25
);

}

.password-box{

position:relative;

}

.password-box input{

padding-right:45px;

}

.toggle-password{

position:absolute;

right:15px;

top:50%;

transform:translateY(-50%);

cursor:pointer;

color:#888;

}

.strength{

height:8px;

border-radius:30px;

background:#ddd;

margin-top:8px;

overflow:hidden;

}

.strength-bar{

height:100%;
width:0%;

transition:.4s;

}

.level{

font-size:12px;

margin-top:5px;

}

.button{

width:100%;

padding:15px;

border:none;

border-radius:12px;

cursor:pointer;

font-size:15px;

font-weight:600;

color:white;

background:
linear-gradient(
90deg,
#d83a2c,
#ff573e
);

}

.error{

padding:12px;

background:#ffe0e0;

border-radius:10px;

margin-bottom:20px;

color:red;

}

.bottom{

text-align:center;

margin-top:20px;

font-size:13px;

}

@media(max-width:500px){

.row{

flex-direction:column;
gap:0;

}

}

</style>

</head>

<body>

<div class="container">

<div class="header">

<div class="logo">

<img src="img/logo_web.png">

</div>

<h1>CERNA</h1>

<p>
Informasi Kesehatan Gastritis
</p>

</div>

<div class="tabs">

<a
href="login.php"
class="login-tab">

MASUK

</a>

<a
href="#"
class="register-tab">

DAFTAR

</a>

</div>

<div class="content">

<?php

if($error!=""){

echo "<div class='error'>$error</div>";

}

?>

<form method="POST">

<div class="row">

<div class="input-box">

<label>Nama Depan</label>

<input
type="text"
name="nama_depan"
placeholder="Masukkan nama depan"
required>

</div>

<div class="input-box">

<label>Nama Belakang</label>

<input
type="text"
name="nama_belakang"
placeholder="Masukkan nama belakang"
required>

</div>

</div>

<div class="input-box">

<label>Tanggal Lahir</label>

<input
type="date"
name="tanggal_lahir"
required>

</div>

<div class="input-box">

<label>Email</label>

<input
type="email"
name="email"
placeholder="Masukkan email"
required>

</div>


<div class="input-box">

<label>Password</label>

<div class="password-box">

<input
type="password"
name="password"
id="password"
placeholder="Minimal 8 karakter"
required>

<i
class="fa-solid fa-eye toggle-password"
onclick="togglePassword('password',this)">
</i>

</div>

<div class="strength">

<div
class="strength-bar"
id="bar">
</div>

</div>

<div
class="level"
id="level">

Minimal 8 karakter

</div>

</div>


<div class="input-box">

<label>Konfirmasi Password</label>

<div class="password-box">

<input
type="password"
name="konfirmasi"
placeholder="Ulangi password"
id="konfirmasi"
required>

<i
class="fa-solid fa-eye toggle-password"
onclick="togglePassword('konfirmasi',this)">
</i>

</div>

</div>

<button
class="button"
name="register">

Buat Akun

</button>

</form>

<div class="bottom">

Sudah punya akun?

<a href="login.php">

Masuk

</a>

</div>

</div>

</div>

<script>

function togglePassword(id,icon){

let input=
document.getElementById(id);

if(input.type==="password"){

input.type="text";

icon.classList.replace(
"fa-eye",
"fa-eye-slash"
);

}else{

input.type="password";

icon.classList.replace(
"fa-eye-slash",
"fa-eye"
);

}

}

let password=
document.getElementById(
"password"
);

password.addEventListener(
"keyup",
function(){

let val=this.value;

let bar=
document.getElementById(
"bar"
);

let level=
document.getElementById(
"level"
);

if(val.length<8){

bar.style.width="25%";
bar.style.background="red";
level.innerHTML=
"Password terlalu pendek";

}

else if(val.length<10){

bar.style.width="60%";
bar.style.background="orange";
level.innerHTML=
"Password sedang";

}

else{

bar.style.width="100%";
bar.style.background="green";
level.innerHTML=
"Password kuat";

}

});

</script>

</body>
</html>