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

$cari="";

if(isset($_GET['cari'])){

$cari=$_GET['cari'];

$query=mysqli_query(
$conn,
"SELECT * FROM users
WHERE nama_depan LIKE '%$cari%'
AND role='user'"
);

}else{

$query=mysqli_query(
$conn,
"SELECT * FROM users
WHERE role='user'"
);

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Data Pengunjung</title>

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

}

.sidebar a:hover{

background:#4a2209;

}

.content{

margin-left:250px;

padding:30px;

width:100%;

}

.header{

display:flex;

justify-content:space-between;

margin-bottom:20px;

}

.search{

padding:10px;

border:1px solid #ddd;

border-radius:10px;

}

.btn{

border:none;

padding:10px 15px;

border-radius:10px;

cursor:pointer;

text-decoration:none;

display:inline-block;

color:white;

}

.tambah{

background:#28a745;
}

.edit{

background:orange;
}

.hapus{

background:red;
}

table{

width:100%;

background:white;

border-collapse:collapse;

box-shadow:
0 0 20px rgba(0,0,0,.1);

border-radius:15px;

overflow:hidden;

}

th{

background:#2a0e00;
color:white;

}

th,td{

padding:15px;
text-align:left;

border-bottom:1px solid #ddd;

}

.modal{

display:none;

position:fixed;

top:0;
left:0;

width:100%;
height:100%;

background:rgba(0,0,0,.5);

justify-content:center;
align-items:center;

}

.modal-box{

background:white;

padding:30px;

width:400px;

border-radius:20px;

}

input{

width:100%;

padding:12px;

margin-bottom:15px;

border:1px solid #ddd;

border-radius:10px;

}

</style>

</head>

<body>

<div class="sidebar">

<h2>Gastritis Admin</h2>

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


<div class="content">

<div class="header">

<form>

<input
class="search"
type="text"
name="cari"
placeholder="Cari pengunjung">

</form>

<button
class="btn tambah"
onclick="openModal()">

+ Tambah Pengunjung

</button>

</div>

<table>

<tr>

<th>ID</th>
<th>Nama</th>
<th>Email</th>
<th>Tanggal Lahir</th>
<th>Aksi</th>

</tr>

<?php while($row=mysqli_fetch_assoc($query)){ ?>

<tr>

<td><?= $row['id']?></td>

<td>

<?= $row['nama_depan']?>
<?= $row['nama_belakang']?>

</td>

<td><?= $row['email']?></td>

<td><?= $row['tanggal_lahir']?></td>

<td>

<button
type="button"
class="btn edit"

onclick="openEditModal(
'<?= $row['id']?>',
'<?= htmlspecialchars($row['nama_depan'])?>',
'<?= htmlspecialchars($row['nama_belakang'])?>',
'<?= $row['tanggal_lahir']?>',
'<?= htmlspecialchars($row['email'])?>'
)">

Edit

</button>


<a
class="btn hapus"
href="hapus-user.php?id=<?= $row['id']?>"
onclick="return confirm('Hapus user?')">

Hapus

</a>

</td>

</tr>

<?php } ?>

</table>

</div>


<div class="modal" id="modal">

<div class="modal-box">

<h2>Tambah Pengunjung</h2>

<form
action="tambah-user.php"
method="POST">

<input
name="nama_depan"
placeholder="Nama depan"
required>

<input
name="nama_belakang"
placeholder="Nama belakang"
required>

<input
type="date"
name="tanggal_lahir"
required>

<input
type="email"
name="email"
placeholder="Email"
required>

<button
class="btn tambah"
name="simpan">

Simpan

</button>

</form>

</div>

</div>



<div class="modal" id="editModal">

<div class="modal-box">

<h2>Edit Pengunjung</h2>

<form
action="edit-user.php"
method="POST">

<input
type="hidden"
name="id"
id="edit_id">

<input
name="nama_depan"
id="edit_nama_depan">

<input
name="nama_belakang"
id="edit_nama_belakang">

<input
type="date"
name="tanggal_lahir"
id="edit_tanggal">

<input
name="email"
id="edit_email">

<button
class="btn edit"
name="update">

Update

</button>

</form>

</div>

</div>


<script>

function openModal(){

document.getElementById(
"modal"
).style.display="flex";

}

function openEditModal(
id,
depan,
belakang,
tanggal,
email
){

document.getElementById(
"editModal"
).style.display="flex";

document.getElementById(
"edit_id"
).value=id;

document.getElementById(
"edit_nama_depan"
).value=depan;

document.getElementById(
"edit_nama_belakang"
).value=belakang;

document.getElementById(
"edit_tanggal"
).value=tanggal;

document.getElementById(
"edit_email"
).value=email;

}

window.onclick=function(e){

if(e.target==modal){

modal.style.display="none";

}

if(e.target==editModal){

editModal.style.display="none";

}

}

</script>

</body>
</html>