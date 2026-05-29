<?php

session_start();
include 'config/database.php';

$error="";

if(isset($_POST['login'])){

$email=trim($_POST['email']);
$password=$_POST['password'];

$query="SELECT * FROM users WHERE email=?";

$stmt=mysqli_prepare(
$conn,
$query
);

mysqli_stmt_bind_param(
$stmt,
"s",
$email
);

mysqli_stmt_execute(
$stmt
);

$result=mysqli_stmt_get_result(
$stmt
);

if(mysqli_num_rows($result)>0){

$data=mysqli_fetch_assoc(
$result
);

if(
password_verify(
$password,
$data['password']
)
){

$_SESSION['id']=$data['id'];

$_SESSION['nama']=$data['nama_depan'];

$_SESSION['role']=$data['role'];

if(
$data['role']=="admin"
){

header(
"Location:admin/dashboard.php"
);

}else{

header(
"Location:index.php"
);

}

exit;

}else{

$error="Password salah";

}

}else{

$error="Email tidak ditemukan";

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

<title>Login Gastritis</title>

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

*{

margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;

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
#391500,
#5a2500
);

}

.container{

width:100%;
max-width:450px;

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

padding:40px;

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

box-shadow:
0 0 20px rgba(
255,
157,
0,
.4
);

}

.header h1{

font-size:30px;

}

.header p{

font-size:13px;
opacity:.8;

margin-top:5px;

}

.tabs{

display:flex;

}

.tabs a{

flex:1;

padding:15px;

text-align:center;

text-decoration:none;

font-weight:600;

}

.login-tab{

background:#d4a038;

color:black;

}

.register-tab{

background:#5d2f17;

color:#d6b8a0;

}

.content{

padding:35px;

}

.content h2{

text-align:center;

margin-bottom:5px;

}

.subtitle{

text-align:center;

font-size:13px;

color:#777;

margin-bottom:25px;

}

.error{

padding:12px;

background:#ffe0e0;

color:red;

font-size:13px;

border-radius:10px;

margin-bottom:20px;

}

.input-box{

margin-bottom:20px;

}

.input-box label{

display:block;

font-size:13px;

font-weight:600;

margin-bottom:8px;

}

.input-box input{

width:100%;

padding:14px;

border:1px solid #ddd;

border-radius:10px;

font-size:14px;

transition:.3s;

}


/* placeholder abu */

.input-box input::placeholder{

color:#aaa;

font-size:13px;

}

.input-box input:focus::placeholder{

opacity:.5;

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


/* password */

.password-box{

position:relative;

}

.password-box input{

padding-right:50px;

}

.toggle-password{

position:absolute;

right:15px;

top:50%;

transform:translateY(-50%);

cursor:pointer;

color:#888;

transition:.3s;

}

.toggle-password:hover{

color:#d69028;

}


/* button */

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

transition:.3s;

}

.button:hover{

transform:translateY(-3px);

}

.bottom{

text-align:center;

margin-top:20px;

font-size:13px;

}

.bottom a{

color:#d4971e;

font-weight:600;

text-decoration:none;

}

</style>

</head>

<body>

<div class="container">

<div class="header">

<div class="logo">

<img src="img/logo_web_new.jpeg">

</div>

<h1>CERNA</h1>

<p>

Informasi Kesehatan Gastritis

</p>

</div>

<div class="tabs">

<a
href="#"
class="login-tab">

MASUK

</a>

<a
href="register.php"
class="register-tab">

DAFTAR

</a>

</div>

<div class="content">

<h2>

Selamat Datang

</h2>

<p class="subtitle">

Masuk untuk mengakses website

</p>

<?php

if($error!=""){

echo "<div class='error'>$error</div>";

}

?>

<form method="POST">

<div class="input-box">

<label>Email</label>

<input
type="email"
name="email"
placeholder="Masukkan email anda"
required>

</div>


<div class="input-box">

<label>Kata Sandi</label>

<div class="password-box">

<input
type="password"
name="password"
id="password"
placeholder="Masukkan kata sandi"
required>

<i
class="fa-solid fa-eye toggle-password"
onclick="togglePassword()">

</i>

</div>

</div>


<button
type="submit"
name="login"
class="button">

Masuk

</button>

</form>


<div class="bottom">

Belum punya akun?

<a href="register.php">

Daftar disini

</a>

</div>

</div>

</div>


<script>

function togglePassword(){

let password=
document.getElementById(
"password"
);

let icon=
document.querySelector(
".toggle-password"
);

if(
password.type==="password"
){

password.type="text";

icon.classList.remove(
"fa-eye"
);

icon.classList.add(
"fa-eye-slash"
);

}else{

password.type="password";

icon.classList.remove(
"fa-eye-slash"
);

icon.classList.add(
"fa-eye"
);

}

}

</script>

</body>
</html>