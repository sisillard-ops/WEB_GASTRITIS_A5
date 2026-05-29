<?php

session_start();
include '../config/database.php';

if(!isset($_SESSION['id'])){
header("Location:../login.php");
exit;
}

if($_SESSION['role']!="admin"){
header("Location:../index.php");
exit;
}

$total=mysqli_query(
$conn,
"SELECT COUNT(*) as jumlah FROM users WHERE role='user'"
);

$data=mysqli_fetch_assoc($total);

$tanggal=date("d F Y");

?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard Admin</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins';
}

body{
display:flex;
background:#f5f5f5;
}


/* SIDEBAR SAMA PERSIS USERS.PHP */

.sidebar{

width:250px;
height:100vh;

position:fixed;

left:0;
top:0;

background:#2a0e00;

padding:25px;

color:white;

}

.sidebar h2{
margin-bottom:30px;
}

.sidebar a{

display:block;

padding:12px;
margin-bottom:10px;

border-radius:10px;

color:white;
text-decoration:none;

transition:.3s;

}

.sidebar a:hover{

background:#4a2209;

}


/* CONTENT */

.main{

margin-left:250px;

padding:30px;

width:100%;

}

.top{

margin-bottom:30px;
}

.top h1{

font-size:30px;

margin-bottom:5px;
}

.top p{

color:gray;
}


/* CARD */

.cards{

display:flex;

gap:25px;

flex-wrap:wrap;

}

.card{

background:white;

padding:25px;

width:280px;

border-radius:20px;

box-shadow:
0 0 20px rgba(
0,0,0,.1
);

transition:.3s;

}

.card:hover{

transform:translateY(-5px);

}

.card-title{

color:gray;

margin-bottom:10px;
}

.card-value{

font-size:40px;

font-weight:700;

color:#2a0e00;

}

.icon{

font-size:35px;

margin-bottom:15px;
}


.info{

margin-top:30px;

background:white;

padding:25px;

border-radius:20px;

box-shadow:
0 0 20px rgba(
0,0,0,.1
);

}

.info h3{

margin-bottom:15px;
}

</style>

</head>

<body>


<!-- SIDEBAR -->

<div class="sidebar">

<h2>
Gastritis Admin
</h2>

<a href="dashboard.php">

Dashboard

</a>

<a href="users.php">

Pengunjung

</a>

<a href="../logout.php">

Logout

</a>

</div>



<!-- CONTENT -->

<div class="main">

<div class="top">

<h1>

Halo Admin 👋

</h1>

<p>

<?= $tanggal ?>

</p>

</div>


<div class="cards">

<div class="card">

<div class="icon">

👥

</div>

<div class="card-title">

Total Pengunjung

</div>

<div class="card-value">

<?= $data['jumlah']; ?>

</div>

</div>


<div class="card">

<div class="icon">

🛡️

</div>

<div class="card-title">

Role

</div>

<div class="card-value">

Admin

</div>

</div>


<div class="card">

<div class="icon">

🌐

</div>

<div class="card-title">

Website

</div>

<div class="card-value">

GASTRITIS

</div>

</div>

</div>


<div class="info">

<h3>
Informasi Sistem
</h3>

<p>

Selamat datang di Dashboard Admin Gastritis.
Gunakan menu Pengunjung untuk mengelola data user yang mendaftar pada website GASTRITIS.

</p>

</div>


</div>

</body>
</html>