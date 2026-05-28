<?php

session_start();

if(
!isset($_SESSION['id'])
){

header(
"Location:login.php"
);

exit;

}

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GASTRITIS – Informasi Kesehatan Gastritis</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --cream: #fdf6ee;
      --dark: #432323;
      --red: #c0392b;
      --red-light: #e74c3c;
      --gold: #c9973a;
      --gold-light: #f0c060;
      --muted: #7a6a58;
      --card-bg: #fff9f2;
      --border: #ecdfd2;
      --green: #27ae60;
      --blue: #2980b9;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--cream);
      color: var(--dark);
      line-height: 1.75;
    }

    /* ===== NAV ===== */

nav{
  position:sticky;
  top:0;
  z-index:9999;

  display:flex;
  align-items:center;
  justify-content:space-between;

  width:100%;
  padding:14px 4vw;

  background:#432323;
  backdrop-filter:blur(10px);

  box-shadow:0 4px 20px rgba(0,0,0,.25);
}

/* BRAND */
.nav-brand-wrap{
  display:flex;
  align-items:center;
  gap:.8rem;
  text-decoration:none;
  flex-shrink:0;
}

.nav-logo-img{
  width:42px;
  height:42px;
  border-radius:10px;
  object-fit:cover;
  background:linear-gradient(135deg,var(--red),var(--gold));
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:1.2rem;
  overflow:hidden;
}

.nav-brand{
  font-family:'Playfair Display',serif;
  font-size:1.35rem;
  font-weight:700;
  color:var(--gold);
  letter-spacing:.04em;
}

.nav-brand span{
  color:#fff;
}

/* NAV LINKS */
.nav-links{
  display:flex;
  align-items:center;
  gap:.3rem;
}

.nav-links a{
  color:#e7dfd4;
  text-decoration:none;
  font-size:.82rem;
  font-weight:600;
  letter-spacing:.08em;
  text-transform:uppercase;

  padding:.75rem 1rem;
  border-radius:10px;

  transition:.25s ease;
}

.nav-links a:hover{
  background:rgba(255,255,255,.08);
  color:var(--gold);
}

.nav-links a.active{
  background:var(--red);
  color:#fff;
}

/* SEARCH */
.search-box{
  position:relative;
  margin-left:.8rem;
}

.search-input{
  width:170px;

  background:rgba(255,255,255,.08);
  border:1px solid rgba(255,255,255,.12);

  border-radius:30px;

  padding:.7rem 1rem .7rem 2.5rem;

  color:#fff;
  font-size:.85rem;

  transition:.3s ease;
}

.search-input::placeholder{
  color:rgba(255,255,255,.45);
}

.search-input:focus{
  width:220px;
  outline:none;

  background:rgba(255,255,255,.12);
  border-color:var(--gold);
}

.search-icon{
  position:absolute;
  top:50%;
  left:14px;
  transform:translateY(-50%);
  color:rgba(255,255,255,.7);
  font-size:.9rem;
}

/* SEARCH RESULT */
.search-results{
  position:absolute;
  top:110%;
  right:0;

  width:280px;
  max-height:300px;

  overflow-y:auto;

  background:#fff;
  border-radius:14px;

  box-shadow:0 10px 30px rgba(0,0,0,.18);

  display:none;
  z-index:1000;
}

.search-results.active{
  display:block;
}

.search-result-item{
  padding:1rem;
  border-bottom:1px solid var(--border);
  cursor:pointer;
  transition:.2s;
}

.search-result-item:hover{
  background:var(--cream);
}

.search-result-item h4{
  font-size:.9rem;
  color:var(--dark);
  margin-bottom:.2rem;
}

.search-result-item p{
  font-size:.75rem;
  color:var(--muted);
}

/* DROPDOWN */
.dropdown-container{
  position:relative;
}

.dropdown-btn{
  background:var(--red);
  color:#fff;

  border:none;
  border-radius:10px;

  padding:.75rem 1rem;

  font-size:.82rem;
  font-weight:600;
  letter-spacing:.05em;
  text-transform:uppercase;

  cursor:pointer;

  display:flex;
  align-items:center;
  gap:.5rem;

  transition:.25s ease;
}

.dropdown-btn:hover{
  background:var(--red-light);
}

.dropdown-btn::after{
  content:'▼';
  font-size:.6rem;
  transition:.3s;
}

.dropdown-btn.active::after{
  transform:rotate(180deg);
}

.dropdown-content{
  position:absolute;
  top:110%;
  left:0;

  min-width:240px;

  background:#fff;
  border-radius:14px;

  overflow:hidden;

  border:1px solid var(--border);

  box-shadow:0 10px 30px rgba(0,0,0,.15);

  opacity:0;
  visibility:hidden;
  transform:translateY(10px);

  transition:.25s ease;

  z-index:1000;
}

.dropdown-content.show{
  opacity:1;
  visibility:visible;
  transform:translateY(0);
}

.dropdown-content a{
  display:flex;
  align-items:center;
  gap:.8rem;

  padding:1rem;

  color:var(--dark);
  text-decoration:none;
  font-size:.9rem;

  border-bottom:1px solid var(--border);

  transition:.2s;
}

.dropdown-content a:last-child{
  border-bottom:none;
}

.dropdown-content a:hover{
  background:var(--cream);
  color:var(--red);
}

.dropdown-content a i{
  color:var(--gold);
  width:18px;
}

/* LOGOUT */
.logout-btn{
  background:#fff;
  color:var(--red);

  border:none;
  border-radius:10px;

  padding:.75rem 1rem;

  font-size:.82rem;
  font-weight:700;

  cursor:pointer;

  display:flex;
  align-items:center;
  gap:.5rem;

  transition:.25s ease;
}

.logout-btn:hover{
  background:var(--red);
  color:#fff;
}
/* =========================================
   LOGOUT ANIMATION
========================================= */

#logoutOverlay{

position:fixed;

top:0;
left:0;

width:100%;
height:100%;

background:rgba(
255,
255,
255,
0.95
);

display:flex;

justify-content:center;
align-items:center;

z-index:99999;

opacity:0;
visibility:hidden;

transition:.5s;

}

#logoutOverlay.show{

opacity:1;

visibility:visible;

}

.logout-box{

text-align:center;

animation:popup .5s;

}

.logout-loader{

width:60px;
height:60px;

border:5px solid #eee;

border-top:5px solid var(--red);

border-radius:50%;

margin:auto;
margin-bottom:15px;

animation:spin .8s linear infinite;

}

.logout-box p{

font-size:18px;
font-weight:600;

color:var(--dark);

}

@keyframes spin{

100%{

transform:rotate(360deg);

}

}

@keyframes popup{

from{

opacity:0;
transform:scale(.7);

}

to{

opacity:1;
transform:scale(1);

}

}
/* HAMBURGER */
.hamburger{
  display:none;
  flex-direction:column;
  gap:5px;

  background:none;
  border:none;

  cursor:pointer;
  z-index:10001;
}

.hamburger span{
  width:26px;
  height:3px;

  background:#fff;
  border-radius:10px;

  transition:.3s;
}

.hamburger.active span:nth-child(1){
  transform:rotate(45deg) translate(5px,6px);
}

.hamburger.active span:nth-child(2){
  opacity:0;
}

.hamburger.active span:nth-child(3){
  transform:rotate(-45deg) translate(5px,-6px);
}

/* MOBILE */
@media(max-width:768px){

  .hamburger{
    display:flex;
  }

  .nav-links{
    position:fixed;
    top:0;
    right:-100%;

    width:85%;
    max-width:320px;
    height:100vh;

    background:#151515;

    flex-direction:column;
    align-items:flex-start;

    padding:90px 20px 30px;

    overflow-y:auto;

    transition:.35s ease;

    box-shadow:-10px 0 30px rgba(0,0,0,.4);
  }

  .nav-links.active{
    right:0;
  }

  .nav-links a,
  .dropdown-btn,
  .logout-btn{
    width:100%;
    justify-content:flex-start;
  }

  .search-box{
    width:100%;
    margin-top:.5rem;
  }

  .search-input{
    width:100%;
  }

  .search-input:focus{
    width:100%;
  }

  .search-results{
    position:static;
    width:100%;
    margin-top:10px;
  }

  .dropdown-container{
    width:100%;
  }

  .dropdown-content{
    position:static;
    width:100%;
    margin-top:10px;
    transform:none;
  }
}

    /* ===== HERO ===== */
    #home {
      position: relative; overflow: hidden;
      min-height: 480px; height: auto; background: var(--dark);
    }
    .slide {
      position: absolute; inset: 0;
      display: flex; align-items: center; justify-content: center;
      flex-direction: column; gap: 1rem;
      opacity: 0; transition: opacity 1s ease; padding: 2rem; text-align: center;
    }
    .slide.active { opacity: 1; }
    .slide::before {
      content: ''; position: absolute; inset: 0;
      background: linear-gradient(135deg, rgba(192,57,43,.75) 0%, rgba(26,18,8,.88) 100%);
      z-index: 0;
    }
    .slide-emoji { font-size: 5rem; position: relative; z-index: 1; animation: float 3s ease-in-out infinite; }
    @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    .slide-content { position: relative; z-index: 1; max-width: 680px; }
    .slide-badge {
      display: inline-block; background: var(--gold); color: var(--dark);
      font-size: .75rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
      padding: .25rem .8rem; border-radius: 20px; margin-bottom: .8rem;
    }
    .slide-content h2 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 4.5vw, 3.2rem); color: #fff; line-height: 1.2; margin-bottom: .6rem;
    }
    .slide-content p { color: #e8ddd0; font-size: 1.05rem; }
    .dots {
      position: absolute; bottom: 22px; left: 50%; transform: translateX(-50%);
      display: flex; gap: 10px; z-index: 5;
    }
    .dot {
      width: 10px; height: 10px; border-radius: 50%;
      background: rgba(255,255,255,.35); cursor: pointer;
      transition: background .3s, transform .3s; border: none;
    }
    .dot.active { background: var(--gold); transform: scale(1.4); }

    /* ===== SHARED ===== */
    .sec { padding: 5vw 2vw; }
    .container { max-width: 1040px; margin: 0 auto; padding: 0 16px; }
    .section-label {
      display: inline-block; font-size: .72rem; font-weight: 700; letter-spacing: .15em;
      text-transform: uppercase; color: var(--red);
      border-bottom: 2px solid var(--red); padding-bottom: 3px; margin-bottom: .8rem;
    }
    .section-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.8rem, 3.5vw, 2.6rem); line-height: 1.25; margin-bottom: 1.5rem;
    }
    .section-title span { color: var(--red); }
    .divider {
      width: 60px; height: 4px;
      background: linear-gradient(90deg, var(--red), var(--gold));
      border-radius: 2px; margin-bottom: 2.5rem;
    }
    .btn {
      display: inline-block; margin-top: 1.2rem;
      background: var(--red); color: #fff; text-decoration: none;
      padding: .6rem 1.6rem; border-radius: 8px; font-weight: 700; font-size: .9rem;
      transition: background .2s, transform .15s, box-shadow .2s;
      box-shadow: 0 4px 14px rgba(192,57,43,.35);
    }
    .btn:hover { background: var(--red-light); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(192,57,43,.4); }
    .btn-outline {
      background: transparent; color: var(--red);
      border: 2px solid var(--red); box-shadow: none; margin-left: .6rem;
    }
    .btn-outline:hover { background: var(--red); color: #fff; }

    /* ===== ARTIKEL / NEWS ===== */
    #news { background: var(--cream); }
    .intro-card {
      background: var(--card-bg); border-left: 6px solid var(--red);
      border-radius: 0 16px 16px 0; padding: 2.5rem 3rem;
      margin-bottom: 3rem; box-shadow: 0 6px 30px rgba(0,0,0,.08);
      position: relative; overflow: hidden;
    }
    .intro-card::after {
      content: '🦠'; position: absolute; right: 2rem; top: 50%;
      transform: translateY(-50%); font-size: 7rem; opacity: .07; pointer-events: none;
    }
    .intro-card p { color: var(--muted); font-size: 1.05rem; max-width: 720px; }
    
    .intro-card .btn-read-more {
      display: inline-block; margin-top: 1.2rem;
      background: var(--red); color: #fff; text-decoration: none;
      padding: .6rem 1.6rem; border-radius: 8px; font-weight: 700; font-size: .9rem;
      transition: background .2s, transform .15s, box-shadow .2s;
      box-shadow: 0 4px 14px rgba(192,57,43,.35);
    }
    .intro-card .btn-read-more:hover { background: var(--red-light); transform: translateY(-2px); }

    /* ===== GAMBAR ILUSTRASI TENGAH ===== */
    .illus-center {
      text-align: center; margin-bottom: 3rem;
    }
    .illus-center img {
      max-width: 520px; width: 100%; border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0,0,0,.15);
      display: inline-block;
    }
    .illus-center p {
      font-size: 1.05rem; color: var(--muted); margin-top: .8rem; font-weight: 700;
    }

    /* ===== PENYEBAB CARDS ===== */
.causes-section{
margin-bottom:3rem;
}

.causes-grid{

display:grid;

grid-template-columns:
repeat(
auto-fit,
minmax(220px,1fr)
);

gap:1.5rem;

}

.cause-card{

height:220px;

perspective:1000px;

}

.cause-inner{

width:100%;
height:100%;

position:relative;

transform-style:preserve-3d;

transition:transform .7s;

}

.cause-card:hover .cause-inner{

transform:rotateY(180deg);

}

.cause-front,
.cause-back{

position:absolute;

width:100%;
height:100%;

backface-visibility:hidden;

border-radius:16px;

padding:1.5rem;

display:flex;

flex-direction:column;

justify-content:center;

align-items:center;

text-align:center;

border:1.5px solid var(--border);

box-shadow:
0 4px 14px rgba(0,0,0,.08);

}

.cause-front{

background:var(--card-bg);

}

.cause-back{

background:linear-gradient(
135deg,
#c0392b,
#e74c3c
);

color:white;

transform:rotateY(180deg);

}

.cause-ico{

font-size:3rem;

margin-bottom:.8rem;

}

.cause-front h4{

font-size:1rem;

font-weight:700;

color:var(--dark);

}

.cause-back p{

font-size:.9rem;

line-height:1.6;

}
    /* ===== GEJALA TABLE (di halaman utama diringkas) ===== */
    .sympt-grid {
      display: grid; grid-template-columns: repeat(auto-fit,minmax(200px,1fr));
      gap: 1.2rem; margin-top: 2rem;
    }
    .sympt-card {
      background: var(--card-bg); border: 1px solid var(--border);
      border-radius: 14px; padding: 1.5rem 1.2rem; text-align: center;
      transition: transform .2s, box-shadow .2s;
    }
    .sympt-card:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(0,0,0,.1); }
    .sympt-card .ico { font-size: 2.2rem; margin-bottom: .6rem; }
    .sympt-card h4 { font-size: 1rem; font-weight: 700; margin-bottom: .3rem; }
    .sympt-card p { font-size: .88rem; color: var(--muted); }

    /* ===== CONTACT ===== */
    #contact { background: #fff; }
    .contact-wrap {
      display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start;
    }
    @media(max-width:700px){.contact-wrap{grid-template-columns:1fr;}}
    .sources-list { display: flex; flex-direction: column; gap: .8rem; margin-top: 1rem; }
    .source-link {
      display: flex; align-items: center; gap: .8rem; background: var(--card-bg);
      border: 1px solid var(--border); border-radius: 10px; padding: .9rem 1.2rem;
      text-decoration: none; color: var(--dark);
      transition: border-color .2s, box-shadow .2s, transform .15s;
    }
    .source-link:hover { border-color: var(--blue); box-shadow: 0 4px 16px rgba(41,128,185,.15); transform: translateX(4px); }
    .source-link .src-ico { font-size: 1.5rem; flex-shrink: 0; }
    .source-link .src-info strong { display: block; font-size: .95rem; }
    .source-link .src-info span { font-size: .82rem; color: var(--blue); }
    .contact-form { display: flex; flex-direction: column; gap: 1rem; }
    .form-group label { font-size: .85rem; font-weight: 700; display: block; margin-bottom: .3rem; }
    .form-group input, .form-group textarea {
      width: 100%; background: var(--card-bg); border: 1px solid var(--border);
      border-radius: 8px; padding: .7rem 1rem;
      font-family: 'DM Sans', sans-serif; font-size: .95rem; color: var(--dark);
      outline: none; transition: border-color .2s;
    }
    .form-group input:focus, .form-group textarea:focus { border-color: var(--red); }
    .form-group textarea { resize: vertical; min-height: 110px; }
    .btn-send {
      background: var(--red); color: #fff; border: none; padding: .7rem 1.8rem;
      border-radius: 8px; font-family: 'DM Sans', sans-serif; font-size: .95rem;
      font-weight: 700; cursor: pointer; transition: background .2s, transform .15s;
      box-shadow: 0 4px 14px rgba(192,57,43,.35);
    }
    .btn-send:hover { background: var(--red-light); transform: translateY(-2px); }

    /* ===== ABOUT ===== */
    #about { background: var(--dark); color: #e8ddd0; }
    #about .section-label { color: var(--gold); border-color: var(--gold); }
    #about .section-title { color: #fff; }
    #about .section-title span { color: var(--gold); }
    #about .divider { background: linear-gradient(90deg, var(--gold), var(--gold-light)); }
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; margin-top: 2rem; align-items: start; }
    @media(max-width:700px){.about-grid{grid-template-columns:1fr;}}
    .about-text p { color: #e2d5c8; font-size: 1rem; margin-bottom: 1rem; }
    .stat-row { display: grid; grid-template-columns: repeat(3,1fr); gap: 1rem; margin-top: 2rem; }
    .stat-card {
      background: rgba(255,255,255,.09); border: 1px solid rgba(255,255,255,.18);
      border-radius: 12px; padding: 1.4rem 1rem; text-align: center;
    }
    .stat-card .val { font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--gold-light); font-weight: 900; }
    .stat-card .lbl { font-size: .82rem; color: #c8b8a5; margin-top: .2rem; }

    /* ===== ANGGOTA TIM – FLIP CARD ===== */
    .tm-section { padding: 5vw 2vw; background: #f5ede0; }
    .tm-container { max-width: 1100px; margin: 0 auto; padding: 0 16px; }
    .tm-label {
      display: inline-block; font-size: .72rem; font-weight: 700; letter-spacing: .15em;
      text-transform: uppercase; color: #a0522d; border-bottom: 2px solid #a0522d;
      padding-bottom: 3px; margin-bottom: .8rem;
    }
    .tm-title {
      font-family: 'Playfair Display', serif; font-size: clamp(1.8rem, 3.5vw, 2.6rem);
      color: #5c3d1e; line-height: 1.25; margin-bottom: 1.5rem;
    }
    .tm-title span { color: #a0522d; }
    .tm-divider {
      width: 60px; height: 4px;
      background: linear-gradient(90deg, #a0522d, #c49a6c);
      border-radius: 2px; margin-bottom: 2.5rem;
    }
    .tm-wrap {
      background: linear-gradient(135deg, #fdf6ee 0%, rgba(196,154,108,.08) 100%);
      border-radius: 16px; border: 1px solid #d4b896; padding: 2rem;
    }
    /* hint teks hover */
    .tm-hint {
      text-align: center;
      font-size: .8rem;
      color: #a0522d;
      margin-bottom: 1.5rem;
      letter-spacing: .04em;
      opacity: .75;
    }
    .tm-hint i { margin-right: .3rem; }

    /* GRID – 1 baris 5 kolom proporsional */
    .tm-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 1.2rem;
    }

    /* FLIP CARD WRAPPER */
    .tm-card {
      height: 280px;
      perspective: 1000px;
      cursor: pointer;
    }

    /* INNER (flipper) */
    .tm-card-inner {
      width: 100%; height: 100%;
      position: relative;
      transform-style: preserve-3d;
      transition: transform .7s cubic-bezier(.4,0,.2,1);
    }
    .tm-card:hover .tm-card-inner,
    .tm-card.flipped .tm-card-inner {
      transform: rotateY(180deg);
    }

    /* FRONT & BACK SHARED */
    .tm-front, .tm-back {
      position: absolute; inset: 0;
      backface-visibility: hidden;
      border-radius: 16px;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      padding: 1.2rem .9rem;
      text-align: center;
      border: 2px solid #d4b896;
      box-shadow: 0 4px 14px rgba(92,61,30,.09);
    }

    /* FRONT */
    .tm-front {
      background: #fff;
    }
    .tm-photo-wrap {
      width: 82px; height: 82px; margin: 0 auto .8rem; border-radius: 14px;
      border: 3px solid #c49a6c; overflow: hidden; background: #e8d5be;
    }
    .tm-photo-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .tm-nama { font-size: .88rem; font-weight: 700; color: #5c3d1e; line-height: 1.35; margin-bottom: .35rem; }
    .tm-nim {
      display: inline-block; background: #a0522d; color: #fdf0e3;
      font-size: .68rem; font-weight: 700; padding: .18rem .65rem;
      border-radius: 20px; letter-spacing: .04em; margin-bottom: .3rem;
    }
    .tm-kelas { font-size: .75rem; color: #8b5e3c; }

    /* front flip hint icon */
    .tm-flip-hint {
      margin-top: .6rem;
      font-size: .68rem;
      color: #a0522d;
      opacity: .6;
      letter-spacing: .04em;
    }
    .tm-flip-hint i { font-size: .65rem; }

    /* BACK */
    .tm-back {
      background: linear-gradient(145deg, #7b3f1e, #a0522d);
      transform: rotateY(180deg);
      border-color: #c49a6c;
      gap: .5rem;
    }
    .tm-back-role {
      font-family: 'Playfair Display', serif;
      font-size: 1rem;
      font-weight: 700;
      color: #fdf0e3;
      margin-bottom: .2rem;
      line-height: 1.3;
    }
    .tm-back-badge {
      display: inline-block;
      background: rgba(255,255,255,.15);
      color: #f0c060;
      font-size: .65rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      padding: .2rem .7rem;
      border-radius: 20px;
      border: 1px solid rgba(240,192,96,.35);
      margin-bottom: .6rem;
    }
    .tm-back-desc {
      font-size: .78rem;
      color: #e8d5be;
      line-height: 1.6;
    }
    .tm-back-tasks {
      list-style: none;
      padding: 0; margin: .4rem 0 0;
      display: flex; flex-direction: column; gap: .3rem;
      width: 100%;
    }
    .tm-back-tasks li {
      font-size: .73rem;
      color: #fdf0e3;
      display: flex; align-items: flex-start; gap: .4rem;
      text-align: left;
    }
    .tm-back-tasks li::before {
      content: '✦';
      color: #f0c060;
      flex-shrink: 0;
      font-size: .6rem;
      margin-top: .15rem;
    }

    /* RESPONSIVE */
    @media(max-width: 1024px) {
      .tm-grid { grid-template-columns: repeat(5, 1fr); gap: .8rem; }
      .tm-card { height: 260px; }
      .tm-photo-wrap { width: 70px; height: 70px; }
      .tm-nama { font-size: .8rem; }
    }
    @media(max-width: 768px) {
      .tm-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; }
      .tm-card { height: 270px; }
    }
    @media(max-width: 500px) {
      .tm-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media(max-width: 340px) {
      .tm-grid { grid-template-columns: 1fr; }
    }

    /* ===== LOGO INSTANSI BAWAH ===== */
    .instansi-section {
      background: #fff; padding: 3rem 2vw; border-top: 1px solid var(--border);
    }
    .instansi-container { max-width: 900px; margin: 0 auto; padding: 0 16px; text-align: center; }
    .instansi-title {
      font-family: 'Playfair Display', serif; font-size: 1.2rem;
      color: var(--muted); margin-bottom: 2rem; letter-spacing: .08em; text-transform: uppercase;
    }
    .instansi-logos {
      display: flex; align-items: center; justify-content: center;
      gap: 3rem; flex-wrap: wrap;
    }
    .instansi-logo-item {
      display: flex; flex-direction: column; align-items: center; gap: .6rem;
    }
    .instansi-logo-img {
      width: 80px; height: 80px; object-fit: contain;
      filter: grayscale(20%); transition: filter .3s, transform .3s;
    }
    .instansi-logo-img:hover { filter: grayscale(0%); transform: scale(1.08); }
    .instansi-logo-emoji {
      width: 80px; height: 80px; font-size: 3.5rem;
      display: flex; align-items: center; justify-content: center;
      background: linear-gradient(135deg, #f5ede0, #e8d5be);
      border-radius: 12px; border: 2px solid #d4b896;
    }
    .instansi-logo-name { font-size: .78rem; color: var(--muted); font-weight: 600; max-width: 100px; text-align: center; }

    /* ===== FOOTER ===== */
    footer {
      background: #432323; color: #b8a898;
      text-align: center; padding: 2rem; font-size: .85rem;
    }
    footer a { color: var(--gold-light); text-decoration: none; }
    footer a:hover { text-decoration: underline; }
    footer strong { color: #f0e6d8; }

    /* ===== BACK TO TOP ===== */
    #btt {
      position: fixed; bottom: 24px; right: 24px; z-index: 999;
      background: var(--red); color: #fff; border: none; border-radius: 50%;
      width: 44px; height: 44px; font-size: 1.2rem; cursor: pointer;
      opacity: 0; pointer-events: none; transition: opacity .3s, transform .3s;
      box-shadow: 0 4px 16px rgba(192,57,43,.5);
    }
    #btt.show { opacity: 1; pointer-events: all; }
    #btt:hover { transform: translateY(-3px); }

    /* ===== SCROLL REVEAL ===== */
    .reveal { opacity: 0; transform: translateY(28px); transition: opacity .65s ease, transform .65s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    .responsive-img { max-width: 100%; height: auto; }


    /* ===== RESPONSIVE ===== */
    @media(max-width: 992px) {
      #home { min-height: 400px; }
      .slide-emoji { font-size: 4rem; }
    }
    @media(max-width: 768px) {
      #home { min-height: 350px; }
      .slide { padding: 1.5rem; }
      .slide-emoji { font-size: 3.5rem; }
      .slide-content p { font-size: 0.95rem; }
      .intro-card { padding: 1.5rem 2rem; }
      .causes-grid { grid-template-columns: repeat(2, 1fr); }
      .stat-row { grid-template-columns: 1fr; gap: 0.8rem; }
    }
    @media(max-width: 576px) {
      .sec { padding: 6vw 4vw; }
      .causes-grid { grid-template-columns: 1fr 1fr; }
      .btn, .btn-outline { display: block; width: 100%; text-align: center; margin: 0.8rem 0 0; margin-left: 0; }
      .instansi-logos { gap: 1.5rem; }
    }
    @media(max-width: 400px) {
      .causes-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>



<!-- ===== KONTEN UTAMA ===== -->
<div id="main-content" class="unlocked" style="display:block;opacity:1;">

<nav>

  <a href="#home" class="nav-brand-wrap">
    <img src="img/logo_web_new2.jpeg"
         alt="Logo CERNA"
         class="nav-logo-img"
         style="background:transparent;padding:2px;"
         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

    <div class="nav-logo-img" style="display:none;"></div>

    <div class="nav-brand">
      CERNA
    </div>
  </a>

  <button class="hamburger" id="hamburger" aria-label="Menu">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <div class="nav-links" id="navLinks">

    <a href="#home">Home</a>
    <a href="#news">Artikel</a>
    <a href="#gejala-page">Gejala</a>
    <a href="#penanganan-page">Penanganan</a>
    <a href="#contact">Sumber</a>
    <a href="#about">Tentang</a>

    <!-- Dropdown -->
    <div class="dropdown-container">

      <button class="dropdown-btn" id="dropdownBtn">
        Menu Info
      </button>

      <div class="dropdown-content" id="dropdownContent">

        <a href="#news">
          <i class="fas fa-info-circle"></i>
          Penjelasan Gastritis
        </a>

        <a href="#penyebab">
          <i class="fas fa-flask"></i>
          Penyebab
        </a>

        <a href="#gejala-page">
          <i class="fas fa-heartbeat"></i>
          Gejala
        </a>

        <a href="#penanganan-page">
          <i class="fas fa-pills"></i>
          Penanganan
        </a>

      </div>
    </div>

    <!-- Search -->
    <div class="search-box">

      <i class="fas fa-search search-icon"></i>

      <input type="text"
             class="search-input"
             placeholder="Cari..."
             id="searchInput">

      <div class="search-results" id="searchResults"></div>

    </div>

    <!-- Logout -->
    <button class="logout-btn" onclick="handleLogout()">
      <i class="fas fa-sign-out-alt"></i>
      Keluar
    </button>

  </div>

</nav>

<!-- HERO -->
<section id="home">
  <div class="slide active">
    <div class="slide-emoji">🦠</div>
    <div class="slide-content">
      <div class="slide-badge">Promosi Kesehatan</div>
      <h2>Kenali Penyakit Gastritis</h2>
      <p>Informasi lengkap seputar gejala, penyebab, dan pencegahan Gastritis untuk masyarakat Indonesia.</p>
    </div>
  </div>
  <div class="slide">
    <div class="slide-emoji">🌡️</div>
    <div class="slide-content">
      <div class="slide-badge">Penyakit Peradangan</div>
      <h2>Angka kejadiannya cukup tinggi di Indonesia</h2>
      <p>Penanganan tepat diperlukan untuk mencegah komplikasi serius seperti tukak lambung atau perdarahan.</p>
    </div>
  </div>
  <div class="slide">
    <div class="slide-emoji">⚠️</div>
    <div class="slide-content">
      <div class="slide-badge">Pencegahan</div>
      <h2>Jaga Pola Makan, Cegah Gastritis!</h2>
      <p>Perhatikan pola makan, hindari makanan yang mengiritasi, berhenti merokok, dan kelola stres sebagai langkah utama pencegahan.</p>
    </div>
  </div>
  <div class="dots">
    <button class="dot active" data-idx="0"></button>
    <button class="dot" data-idx="1"></button>
    <button class="dot" data-idx="2"></button>
  </div>
</section>

<!-- ARTIKEL -->
<section id="news" class="sec">
  <div class="container">
    <span class="section-label">Artikel Kesehatan</span>
    <h2 class="section-title"><span>Gastritis</span> — Peradangan Lambung</h2>
    <div class="divider"></div>

    <div class="intro-card reveal">
      <p>
        <strong>Gastritis (peradangan lambung)</strong> adalah penyakit peradangan pada dinding lambung yang ditandai dengan nyeri di ulu hati atau lambung yang disebabkan oleh bakteri
        <em>Helicobacter pylori</em>. Jika dibiarkan, gastritis bisa berlangsung bertahun-tahun dan menyebabkan komplikasi serius, seperti tukak lambung.
        Gastritis terbagi dua, yaitu <strong>gastritis akut</strong> (tiba-tiba, nyeri hebat sementara) dan <strong>gastritis kronis</strong> (berlangsung bertahap, nyeri lebih ringan namun lebih sering).
        Prevalensi gastritis di Indonesia cukup tinggi, dengan angka kejadian mencapai <strong>274.396 kasus dari 238.452.952 jiwa penduduk</strong>.
      </p>
      
      <a href="https://fmj.fk.umi.ac.id/index.php/fmj" target="_blank" class="btn-read-more btn" style="margin-right:.6rem;">Baca Selengkapnya →</a>
      
    </div>

    
    <div class="illus-center reveal">
      <img src="https://images.alodokter.com/dk0z4ums3/image/upload/v1618160886/attached_image/gastritis-0-alodokter.jpg" alt="Ilustrasi Penderita Gastritis" class="responsive-img">
      <p> Ilustrasi: Penderita Gastritis</p>
    </div>

<div id="penyebab" class="causes-section reveal">

    <span class="section-label">Penyebab</span>

    <h3 class="section-title" style="font-size:1.8rem;">
        Penyebab <span>Gastritis</span>
    </h3>

    <div class="causes-grid">

        <!-- Card -->

        <div class="cause-card">

            <div class="cause-inner">

                <div class="cause-front">

                    <span class="cause-ico">🚬</span>
                    <h4>Kebiasaan Merokok</h4>

                </div>

                <div class="cause-back">

                    <p>
                        Nikotin merusak lapisan pelindung lambung dan meningkatkan produksi asam lambung.
                    </p>

                </div>

            </div>

        </div>


        <div class="cause-card">

            <div class="cause-inner">

                <div class="cause-front">

                    <span class="cause-ico">🧂</span>
                    <h4>Pola Makan Tidak Sehat</h4>

                </div>

                <div class="cause-back">

                    <p>
                        Konsumsi makanan tinggi lemak, garam, atau pedas berlebihan dapat meradangkan lambung.
                    </p>

                </div>

            </div>

        </div>


        <div class="cause-card">

            <div class="cause-inner">

                <div class="cause-front">

                    <span class="cause-ico">👴</span>
                    <h4>Pertambahan Usia</h4>

                </div>

                <div class="cause-back">

                    <p>
                        Dinding lambung semakin menipis seiring bertambahnya usia.
                    </p>

                </div>

            </div>

        </div>


        <div class="cause-card">

            <div class="cause-inner">

                <div class="cause-front">

                    <span class="cause-ico">🍺</span>
                    <h4>Konsumsi Alkohol</h4>

                </div>

                <div class="cause-back">

                    <p>
                        Alkohol mengiritasi dan merusak lapisan mukosa lambung secara langsung.
                    </p>

                </div>

            </div>

        </div>


        <div class="cause-card">

            <div class="cause-inner">

                <div class="cause-front">

                    <span class="cause-ico">💊</span>
                    <h4>NSAID</h4>

                </div>

                <div class="cause-back">

                    <p>
                        Penggunaan aspirin atau ibuprofen berlebihan dapat mengganggu lapisan lambung.
                    </p>

                </div>

            </div>

        </div>


        <div class="cause-card">

            <div class="cause-inner">

                <div class="cause-front">

                    <span class="cause-ico">🏥</span>
                    <h4>Operasi Besar</h4>

                </div>

                <div class="cause-back">

                    <p>
                        Operasi besar dapat meningkatkan risiko iritasi lambung.
                    </p>

                </div>

            </div>

        </div>


        <div class="cause-card">

            <div class="cause-inner">

                <div class="cause-front">

                    <span class="cause-ico">🩺</span>
                    <h4>Penyakit Ginjal/Liver</h4>

                </div>

                <div class="cause-back">

                    <p>
                        Gangguan organ tertentu dapat mempengaruhi keseimbangan sistem pencernaan.
                    </p>

                </div>

            </div>

        </div>


        <div class="cause-card">

            <div class="cause-inner">

                <div class="cause-front">

                    <span class="cause-ico">🦠</span>
                    <h4>Infeksi H. pylori</h4>

                </div>

                <div class="cause-back">

                    <p>
                        Helicobacter pylori adalah penyebab gastritis kronis yang paling umum.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

    <!-- Ringkasan gejala + link ke halaman gejala -->
    <div class="reveal" style="margin-top:3rem; text-align:center;">
      <span class="section-label">Gejala</span>
      <h3 class="section-title" style="font-size:1.8rem;">Gejala yang Perlu <span>Diwaspadai</span></h3>
      <p style="color:var(--muted); max-width:600px; margin:0 auto 1.5rem;">
        Gastritis menimbulkan berbagai gejala yang perlu diwaspadai, mulai dari nyeri ulu hati hingga muntah darah. Pelajari gejala secara lengkap beserta gambar penjelasan.
      </p>
      <a href="#gejala-page" class="btn">Lihat Halaman Gejala →</a>
    </div>

    <!-- Ringkasan penanganan + link ke halaman penanganan -->
    <div class="reveal" style="margin-top:3rem; text-align:center;">
      <span class="section-label">Penanganan</span>
      <h3 class="section-title" style="font-size:1.8rem;">Cara <span>Penanganan</span></h3>
      <p style="color:var(--muted); max-width:600px; margin:0 auto 1.5rem;">
        Penanganan gastritis melibatkan perubahan gaya hidup, pola makan, dan konsultasi medis yang tepat. Pelajari langkah-langkah penanganan secara lengkap.
      </p>
      <a href="#penanganan-page" class="btn">Lihat Halaman Penanganan →</a>
    </div>
  </div>
</section>

<!-- ===== HALAMAN GEJALA ===== -->
<section id="gejala-page" class="sec" style="background:#fff5f5;">
  <div class="container">
    <span class="section-label" style="color:var(--red);">Gejala Gastritis</span>
    <h2 class="section-title">Mengenali <span>Gejala</span> Gastritis</h2>
    <div class="divider"></div>
    <p class="reveal" style="color:var(--muted); max-width:720px; margin-bottom:3rem; font-size:1.05rem;">
      Gastritis dapat menunjukkan berbagai gejala. Kenali gejala-gejala berikut agar dapat segera mendapatkan penanganan yang tepat dari tenaga medis.
    </p>

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:2rem;">

      <!-- Gejala 1 -->
      <div class="reveal" style="background:var(--card-bg); border-radius:16px; border:1.5px solid var(--border); overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.07);">
        <div style="background:linear-gradient(135deg,#ffe0e0,#ffd0d0); padding:2rem; text-align:center;">
          <div style="font-size:3.5rem; margin-bottom:.5rem;">🥴</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:var(--red);">Perut Kembung</h3>
        </div>
        <div style="padding:1.5rem;">
          <p style="color:var(--muted); font-size:.95rem;">Perut terasa penuh, berat, dan tidak nyaman meskipun belum banyak makan. Disebabkan oleh gangguan proses pencernaan akibat peradangan dinding lambung.</p>
          <div style="margin-top:1rem; padding:.8rem 1rem; background:#fff0f0; border-radius:8px; border-left:4px solid var(--red);">
            <strong style="font-size:.85rem; color:var(--red);">⚠️ Kapan waspada:</strong>
            <p style="font-size:.82rem; color:var(--muted); margin-top:.3rem;">Jika kembung disertai nyeri tajam atau terus-menerus lebih dari 2 hari.</p>
          </div>
        </div>
      </div>

      <!-- Gejala 2 -->
      <div class="reveal" style="background:var(--card-bg); border-radius:16px; border:1.5px solid var(--border); overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.07);">
        <div style="background:linear-gradient(135deg,#fff0e0,#ffe0c0); padding:2rem; text-align:center;">
          <div style="font-size:3.5rem; margin-bottom:.5rem;">🤢</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#d35400;">Mual & Muntah</h3>
        </div>
        <div style="padding:1.5rem;">
          <p style="color:var(--muted); font-size:.95rem;">Rasa mual yang terus-menerus, terutama setelah makan, sering disertai keinginan muntah. Merupakan respons tubuh terhadap iritasi pada lapisan lambung.</p>
          <div style="margin-top:1rem; padding:.8rem 1rem; background:#fff8f0; border-radius:8px; border-left:4px solid #e67e22;">
            <strong style="font-size:.85rem; color:#e67e22;">⚠️ Kapan waspada:</strong>
            <p style="font-size:.82rem; color:var(--muted); margin-top:.3rem;">Jika mual disertai demam tinggi atau muntah berulang lebih dari 24 jam.</p>
          </div>
        </div>
      </div>

      <!-- Gejala 3 -->
      <div class="reveal" style="background:var(--card-bg); border-radius:16px; border:1.5px solid var(--border); overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.07);">
        <div style="background:linear-gradient(135deg,#e0f0ff,#c0e0ff); padding:2rem; text-align:center;">
          <div style="font-size:3.5rem; margin-bottom:.5rem;">😮‍💨</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#2980b9;">Cegukan</h3>
        </div>
        <div style="padding:1.5rem;">
          <p style="color:var(--muted); font-size:.95rem;">Cegukan yang berlangsung lama atau berulang dapat menjadi tanda gangguan pada lambung. Peradangan lambung dapat mempengaruhi saraf di sekitar diafragma.</p>
          <div style="margin-top:1rem; padding:.8rem 1rem; background:#f0f8ff; border-radius:8px; border-left:4px solid #2980b9;">
            <strong style="font-size:.85rem; color:#2980b9;">⚠️ Kapan waspada:</strong>
            <p style="font-size:.82rem; color:var(--muted); margin-top:.3rem;">Cegukan yang berlangsung lebih dari 48 jam perlu dievaluasi dokter.</p>
          </div>
        </div>
      </div>

      <!-- Gejala 4 -->
      <div class="reveal" style="background:var(--card-bg); border-radius:16px; border:1.5px solid var(--border); overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.07);">
        <div style="background:linear-gradient(135deg,#e8ffe0,#c8f0b8); padding:2rem; text-align:center;">
          <div style="font-size:3.5rem; margin-bottom:.5rem;">🔄</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#27ae60;">Gangguan Pencernaan</h3>
        </div>
        <div style="padding:1.5rem;">
          <p style="color:var(--muted); font-size:.95rem;">Dispepsia atau gangguan pencernaan meliputi rasa tidak nyaman di perut bagian atas, rasa terbakar, dan kesulitan mencerna makanan dengan normal.</p>
          <div style="margin-top:1rem; padding:.8rem 1rem; background:#f0fff0; border-radius:8px; border-left:4px solid #27ae60;">
            <strong style="font-size:.85rem; color:#27ae60;">⚠️ Kapan waspada:</strong>
            <p style="font-size:.82rem; color:var(--muted); margin-top:.3rem;">Segera konsultasikan ke dokter bila gangguan pencernaan terjadi lebih dari 2 minggu.</p>
          </div>
        </div>
      </div>

      <!-- Gejala 5 -->
      <div class="reveal" style="background:var(--card-bg); border-radius:16px; border:1.5px solid var(--border); overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.07);">
        <div style="background:linear-gradient(135deg,#ffe0e0,#ffc0c0); padding:2rem; text-align:center;">
          <div style="font-size:3.5rem; margin-bottom:.5rem;">🩸</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#c0392b;">Muntah Darah</h3>
        </div>
        <div style="padding:1.5rem;">
          <p style="color:var(--muted); font-size:.95rem;">Gejala serius yang mengindikasikan perdarahan pada lambung. Darah bisa berwarna merah terang atau seperti kopi (hematemesis). Segera cari pertolongan medis!</p>
          <div style="margin-top:1rem; padding:.8rem 1rem; background:#fff0f0; border-radius:8px; border-left:4px solid var(--red);">
            <strong style="font-size:.85rem; color:var(--red);">🚨 DARURAT!</strong>
            <p style="font-size:.82rem; color:var(--muted); margin-top:.3rem;">Muntah darah membutuhkan penanganan medis segera. Langsung ke UGD rumah sakit terdekat.</p>
          </div>
        </div>
      </div>

      <!-- Gejala 6 -->
      <div class="reveal" style="background:var(--card-bg); border-radius:16px; border:1.5px solid var(--border); overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.07);">
        <div style="background:linear-gradient(135deg,#ffe8d0,#ffd0a0); padding:2rem; text-align:center;">
          <div style="font-size:3.5rem; margin-bottom:.5rem;">🔥</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#d35400;">Nyeri Ulu Hati</h3>
        </div>
        <div style="padding:1.5rem;">
          <p style="color:var(--muted); font-size:.95rem;">Rasa nyeri, terbakar, atau perih di bagian atas perut (ulu hati). Nyeri bisa memburuk saat perut kosong atau setelah makan makanan tertentu.</p>
          <div style="margin-top:1rem; padding:.8rem 1rem; background:#fff8f0; border-radius:8px; border-left:4px solid #d35400;">
            <strong style="font-size:.85rem; color:#d35400;">⚠️ Kapan waspada:</strong>
            <p style="font-size:.82rem; color:var(--muted); margin-top:.3rem;">Nyeri yang menjalar ke punggung atau dada bisa mengindikasikan kondisi lebih serius.</p>
          </div>
        </div>
      </div>

      <!-- Gejala 7 -->
      <div class="reveal" style="background:var(--card-bg); border-radius:16px; border:1.5px solid var(--border); overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.07);">
        <div style="background:linear-gradient(135deg,#e8e0ff,#d0c0ff); padding:2rem; text-align:center;">
          <div style="font-size:3.5rem; margin-bottom:.5rem;">🖤</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#6c3483;">Tinja Berwarna Hitam</h3>
        </div>
        <div style="padding:1.5rem;">
          <p style="color:var(--muted); font-size:.95rem;">Tinja berwarna hitam seperti aspal (melena) merupakan tanda perdarahan saluran pencernaan bagian atas. Ini adalah gejala gastritis berat yang tidak boleh diabaikan.</p>
          <div style="margin-top:1rem; padding:.8rem 1rem; background:#f5f0ff; border-radius:8px; border-left:4px solid #6c3483;">
            <strong style="font-size:.85rem; color:#6c3483;">🚨 DARURAT!</strong>
            <p style="font-size:.82rem; color:var(--muted); margin-top:.3rem;">Segera periksakan ke dokter bila BAB berwarna hitam atau mengandung darah.</p>
          </div>
        </div>
      </div>

      <!-- Gejala 8 -->
      <div class="reveal" style="background:var(--card-bg); border-radius:16px; border:1.5px solid var(--border); overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.07);">
        <div style="background:linear-gradient(135deg,#fffae0,#fff0a0); padding:2rem; text-align:center;">
          <div style="font-size:3.5rem; margin-bottom:.5rem;">😔</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#d4ac0d;">Tidak Nafsu Makan</h3>
        </div>
        <div style="padding:1.5rem;">
          <p style="color:var(--muted); font-size:.95rem;">Peradangan lambung menyebabkan rasa tidak nyaman yang membuat seseorang menghindari makan. Penurunan nafsu makan berkepanjangan bisa menyebabkan malnutrisi.</p>
          <div style="margin-top:1rem; padding:.8rem 1rem; background:#fffbf0; border-radius:8px; border-left:4px solid #d4ac0d;">
            <strong style="font-size:.85rem; color:#d4ac0d;">⚠️ Kapan waspada:</strong>
            <p style="font-size:.82rem; color:var(--muted); margin-top:.3rem;">Tidak nafsu makan yang disertai penurunan berat badan signifikan perlu evaluasi medis.</p>
          </div>
        </div>
      </div>

      <!-- Gejala 9 -->
      <div class="reveal" style="background:var(--card-bg); border-radius:16px; border:1.5px solid var(--border); overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.07);">
        <div style="background:linear-gradient(135deg,#e0f8ff,#b8ecff); padding:2rem; text-align:center;">
          <div style="font-size:3.5rem; margin-bottom:.5rem;">🍽️</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#1a8faa;">Cepat Merasa Kenyang</h3>
        </div>
        <div style="padding:1.5rem;">
          <p style="color:var(--muted); font-size:.95rem;">Merasa sangat kenyang meski baru makan sedikit, karena peradangan mengganggu kemampuan lambung untuk menampung makanan secara normal (early satiety).</p>
          <div style="margin-top:1rem; padding:.8rem 1rem; background:#f0fbff; border-radius:8px; border-left:4px solid #1a8faa;">
            <strong style="font-size:.85rem; color:#1a8faa;">⚠️ Kapan waspada:</strong>
            <p style="font-size:.82rem; color:var(--muted); margin-top:.3rem;">Jika disertai nyeri dan berlangsung lebih dari seminggu, segera periksa ke dokter.</p>
          </div>
        </div>
      </div>

    </div><!-- /grid gejala -->

    <div style="margin-top:3rem; text-align:center;" class="reveal">
      <a href="#penanganan-page" class="btn">Lihat Cara Penanganan →</a>
      <a href="#news" class="btn btn-outline" style="margin-left:.6rem;">Kembali ke Artikel</a>
    </div>
  </div>
</section>

<!-- ===== HALAMAN PENANGANAN ===== -->
<section id="penanganan-page" class="sec" style="background:#f0f9f4;">
  <div class="container">
    <span class="section-label" style="color:var(--green);">Penanganan Gastritis</span>
    <h2 class="section-title">Cara <span style="color:var(--green);">Menangani</span> Gastritis</h2>
    <div class="divider" style="background:linear-gradient(90deg, var(--green), #82e0aa);"></div>
    <p class="reveal" style="color:var(--muted); max-width:720px; margin-bottom:3rem; font-size:1.05rem;">
      Penanganan gastritis bertujuan untuk mengurangi peradangan, meredakan gejala, dan mencegah kekambuhan. Berikut langkah-langkah penanganan yang direkomendasikan:
    </p>

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:2rem;">

      <!-- Penanganan 1 -->
      <div class="reveal" style="background:#fff; border-radius:16px; border:2px solid #a9dfbf; overflow:hidden; box-shadow:0 4px 16px rgba(39,174,96,.1);">
        <div style="background:linear-gradient(135deg,#e8fff2,#c8f0da); padding:1.5rem; display:flex; align-items:center; gap:1rem;">
          <div style="width:52px; height:52px; background:var(--green); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:900; font-size:1.3rem; flex-shrink:0;">1</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.15rem; color:#1e8449;">Tidak Mengonsumsi Obat Pereda Nyeri Berlebihan</h3>
        </div>
        <div style="padding:1.5rem;">
          <div style="text-align:center; font-size:2.8rem; margin-bottom:1rem;">💊</div>
          <p style="color:var(--muted); font-size:.95rem; margin-bottom:1rem;">Hentikan atau kurangi penggunaan obat pereda nyeri jenis NSAID (ibuprofen, aspirin) yang dapat mengiritasi lapisan lambung, sesuai saran dokter.</p>
          <ul style="list-style:none; display:flex; flex-direction:column; gap:.5rem;">
            <li style="font-size:.88rem; color:#1e8449; display:flex; gap:.5rem;"><span>✅</span>Konsultasikan penggantian obat dengan dokter</li>
            <li style="font-size:.88rem; color:#1e8449; display:flex; gap:.5rem;"><span>✅</span>Minum obat selalu bersama makanan</li>
            <li style="font-size:.88rem; color:#c0392b; display:flex; gap:.5rem;"><span>❌</span>Jangan minum obat saat perut kosong</li>
          </ul>
        </div>
      </div>

      <!-- Penanganan 2 -->
      <div class="reveal" style="background:#fff; border-radius:16px; border:2px solid #a9dfbf; overflow:hidden; box-shadow:0 4px 16px rgba(39,174,96,.1);">
        <div style="background:linear-gradient(135deg,#e8fff2,#c8f0da); padding:1.5rem; display:flex; align-items:center; gap:1rem;">
          <div style="width:52px; height:52px; background:var(--green); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:900; font-size:1.3rem; flex-shrink:0;">2</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.15rem; color:#1e8449;">Mengubah Pola Makan</h3>
        </div>
        <div style="padding:1.5rem;">
          <div style="text-align:center; font-size:2.8rem; margin-bottom:1rem;">🥗</div>
          <p style="color:var(--muted); font-size:.95rem; margin-bottom:1rem;">Terapkan pola makan yang sehat dan teratur untuk membantu lambung pulih dari peradangan.</p>
          <ul style="list-style:none; display:flex; flex-direction:column; gap:.5rem;">
            <li style="font-size:.88rem; color:#1e8449; display:flex; gap:.5rem;"><span>✅</span>Makan dengan porsi kecil tapi sering (5–6x sehari)</li>
            <li style="font-size:.88rem; color:#1e8449; display:flex; gap:.5rem;"><span>✅</span>Konsumsi makanan berserat tinggi</li>
            <li style="font-size:.88rem; color:#c0392b; display:flex; gap:.5rem;"><span>❌</span>Hindari makanan pedas, asam, dan berlemak</li>
            <li style="font-size:.88rem; color:#c0392b; display:flex; gap:.5rem;"><span>❌</span>Hindari kopi, soda, dan minuman berkafein</li>
          </ul>
        </div>
      </div>

      <!-- Penanganan 3 -->
      <div class="reveal" style="background:#fff; border-radius:16px; border:2px solid #a9dfbf; overflow:hidden; box-shadow:0 4px 16px rgba(39,174,96,.1);">
        <div style="background:linear-gradient(135deg,#e8fff2,#c8f0da); padding:1.5rem; display:flex; align-items:center; gap:1rem;">
          <div style="width:52px; height:52px; background:var(--green); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:900; font-size:1.3rem; flex-shrink:0;">3</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.15rem; color:#1e8449;">Mengubah Gaya Hidup</h3>
        </div>
        <div style="padding:1.5rem;">
          <div style="text-align:center; font-size:2.8rem; margin-bottom:1rem;">🧘</div>
          <p style="color:var(--muted); font-size:.95rem; margin-bottom:1rem;">Perubahan gaya hidup menyeluruh adalah kunci pemulihan jangka panjang dari gastritis.</p>
          <ul style="list-style:none; display:flex; flex-direction:column; gap:.5rem;">
            <li style="font-size:.88rem; color:#1e8449; display:flex; gap:.5rem;"><span>✅</span>Olahraga ringan secara teratur (jalan, yoga)</li>
            <li style="font-size:.88rem; color:#1e8449; display:flex; gap:.5rem;"><span>✅</span>Kelola stres dengan relaksasi dan meditasi</li>
            <li style="font-size:.88rem; color:#1e8449; display:flex; gap:.5rem;"><span>✅</span>Tidur cukup 7–8 jam sehari</li>
            <li style="font-size:.88rem; color:#c0392b; display:flex; gap:.5rem;"><span>❌</span>Hindari minuman beralkohol dan rokok</li>
          </ul>
        </div>
      </div>

      <!-- Penanganan 4 -->
      <div class="reveal" style="background:#fff; border-radius:16px; border:2px solid #a9dfbf; overflow:hidden; box-shadow:0 4px 16px rgba(39,174,96,.1);">
        <div style="background:linear-gradient(135deg,#e8fff2,#c8f0da); padding:1.5rem; display:flex; align-items:center; gap:1rem;">
          <div style="width:52px; height:52px; background:var(--green); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:900; font-size:1.3rem; flex-shrink:0;">4</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.15rem; color:#1e8449;">Konsultasi & Pengobatan Medis</h3>
        </div>
        <div style="padding:1.5rem;">
          <div style="text-align:center; font-size:2.8rem; margin-bottom:1rem;">🩺</div>
          <p style="color:var(--muted); font-size:.95rem; margin-bottom:1rem;">Dokter dapat meresepkan obat-obatan yang tepat untuk mengatasi penyebab dan gejala gastritis.</p>
          <ul style="list-style:none; display:flex; flex-direction:column; gap:.5rem;">
            <li style="font-size:.88rem; color:#1e8449; display:flex; gap:.5rem;"><span>✅</span>Antasida: menetralisir asam lambung</li>
            <li style="font-size:.88rem; color:#1e8449; display:flex; gap:.5rem;"><span>✅</span>PPI: mengurangi produksi asam lambung</li>
            <li style="font-size:.88rem; color:#1e8449; display:flex; gap:.5rem;"><span>✅</span>Antibiotik: bila disebabkan H. pylori</li>
            <li style="font-size:.88rem; color:#1e8449; display:flex; gap:.5rem;"><span>✅</span>Kontrol rutin ke dokter sesuai jadwal</li>
          </ul>
        </div>
      </div>

    </div><!-- /grid penanganan -->

    <!-- Peringatan penting -->
    <div class="reveal" style="margin-top:3rem; padding:2rem; background:#fff3cd; border-radius:16px; border:2px solid #ffd700; text-align:center;">
      <div style="font-size:2rem; margin-bottom:.5rem;">⚠️</div>
      <h3 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#856404; margin-bottom:.5rem;">Penting!</h3>
      <p style="color:#6d4e00; font-size:.95rem; max-width:600px; margin:0 auto;">
        Informasi ini bersifat edukatif. Selalu konsultasikan kondisi kesehatan Anda dengan dokter atau tenaga kesehatan profesional untuk mendapatkan diagnosis dan penanganan yang tepat.
      </p>
    </div>

    <div style="margin-top:2rem; text-align:center;" class="reveal">
      <a href="#gejala-page" class="btn btn-outline" style="border-color:var(--green); color:var(--green);">← Lihat Gejala</a>

    </div>
  </div>
</section>

<!-- KONTAK -->
<section id="contact" class="sec" style="background:#fff;">
  <div class="container">
    <span class="section-label">Sumber</span>
    <h2 class="section-title" style="text-align:center;">Referensi <span>Terpercaya</span></h2>
    <div class="divider" style="margin:0 auto 2.5rem;"></div>

    <div class="reveal" style="max-width:640px; margin:0 auto; text-align:center;">
      <p style="color:var(--muted); margin-bottom:1.5rem; font-size:.95rem;">
        Informasi pada halaman ini bersumber dari situs kesehatan dan lembaga medis terpercaya. Klik untuk membaca selengkapnya:
      </p>
      <div class="sources-list" style="max-width:500px; margin:0 auto;">
        <a href="referensi.php">Lihat Referensi Jurnal</a>
        </a>
        <a href="https://keslan.kemkes.go.id/view_artikel/3297/tangani-gastritis-secara-cepat-dan-tepat" target="_blank" class="source-link">
          <span class="src-ico">🏥</span>
          <div class="src-info">
            <strong>Kemenkes RI – Gastritis</strong>
            <span>Baca Selengkapnya di Kemkes.go.id →</span>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section id="about" class="sec">
  <div class="container">
    <span class="section-label">Tentang Kami</span>
    <h2 class="section-title" style="text-align:center;">Promosi Kesehatan <span>Kelas A</span></h2>
    <div class="divider" style="margin:0 auto 2.5rem;"></div>
    <div class="reveal" style="text-align:center; max-width:720px; margin:0 auto;">
      <p style="color:#ddd0c4; font: size 1.2em;rem; margin-bottom:1rem;">
        Website ini dibuat sebagai bagian dari tugas <strong style="color:#f5ece0;">Promosi Kesehatan</strong>
        dengan tujuan memberikan edukasi yang mudah dipahami kepada masyarakat mengenai penyakit Gastritis.
      </p>
      <p style="color:#ddd0c4; font-size:1.2rem; margin-bottom:1rem;">
        Gastritis masih menjadi masalah kesehatan serius di Indonesia. Dengan informasi yang tepat,
        masyarakat diharapkan mampu mengenali gejala sejak dini, melakukan pencegahan yang efektif,
        dan segera mencari pertolongan medis apabila diperlukan.
      </p>
      <p style="color:#ddd0c4; font-size:1.2rem; margin-bottom:1rem;">
        Seluruh informasi pada website ini mengacu pada sumber-sumber medis terpercaya seperti
        Kementerian Kesehatan RI dan Jurnal Kesehatan.
      </p>
      <div class="stat-row" style="max-width:720px; margin:2rem auto 0;">
        <div class="stat-card">
          <div class="val">40,8%</div>
          <div class="lbl">Kasus gastritis di Indonesia</div>
        </div>
        <div class="stat-card">
          <div class="val">60,86%</div>
          <div class="lbl">Terjadi pada perempuan</div>
        </div>
        <div class="stat-card">
          <div class="val">95%</div>
          <div class="lbl">Pola makan tidak teratur</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ANGGOTA KELOMPOK -->
<section id="anggota" class="tm-section">
  <div class="tm-container">
    <span class="tm-label">Anggota Kelompok</span>
    <h2 class="tm-title">Kelompok <span>5</span></h2>
    <div class="tm-divider"></div>
    <div class="tm-wrap reveal">
      <div class="tm-grid">

        <!-- 1. Sajidah Zulfah – Ketua -->
        <div class="tm-card">
          <div class="tm-card-inner">
            <div class="tm-front">
              <div class="tm-photo-wrap">
                <img src="https://i.ibb.co.com/bptSYzM/SAJIDAH-ZULFAH-jpg.jpg" alt="Sajidah Zulfah">
              </div>
              <p class="tm-nama">Sajidah Zulfah</p>
              <span class="tm-nim">G43250110</span>
              <p class="tm-kelas">Promkes A</p>
            </div>
            <div class="tm-back">
          
              <p class="tm-back-role">Ketua Kelompok</p>
              <ul class="tm-back-tasks">
                <li>Mengkoordinir seluruh anggota</li>
                <li>Menyusun pembagian tugas</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- 2. Sisila Ramadani – Web Developer -->
        <div class="tm-card">
          <div class="tm-card-inner">
            <div class="tm-front">
              <div class="tm-photo-wrap">
                <img src="https://i.ibb.co.com/3mCw0KNN/SISILA-RAMADANI-jpg.jpg" alt="Sisila Ramadani">
              </div>
              <p class="tm-nama">Sisila Ramadani</p>
              <span class="tm-nim">G43250193</span>
              <p class="tm-kelas">Promkes A</p>
            </div>
            <div class="tm-back">
              <p class="tm-back-role">Pengembang Website</p>
              <ul class="tm-back-tasks">
                <li>Merancang & membangun halaman website</li>
                <li>Coding HTML, CSS, dan PHP</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- 3. Herlina Damayanti – Editor Konten -->
        <div class="tm-card">
          <div class="tm-card-inner">
            <div class="tm-front">
              <div class="tm-photo-wrap">
                <img src="https://i.ibb.co.com/tp9CcJvB/HERLINA-DAMAYANTI-jpg.jpg" alt="Herlina Damayanti">
              </div>
              <p class="tm-nama">Herlina Damayanti</p>
              <span class="tm-nim">G43250198</span>
              <p class="tm-kelas">Promkes A</p>
            </div>
            <div class="tm-back">
              <p class="tm-back-role">Penyusun Materi</p>
              <ul class="tm-back-tasks">
                <li>Riset & menyusun materi artikel gastritis</li>
                <li>Menulis konten gejala hingga cara penanganan</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- 4. Putri Selin Mariskha Seruni – Editor Konten -->
        <div class="tm-card">
          <div class="tm-card-inner">
            <div class="tm-front">
              <div class="tm-photo-wrap">
                <img src="https://i.ibb.co.com/FbH4QxTp/PUTRI-SELIN-MARISKHA-SERUNI-jpg.jpg" alt="Putri Selin Mariskha Seruni">
              </div>
              <p class="tm-nama">Putri Selin M. S.</p>
              <span class="tm-nim">G43250838</span>
              <p class="tm-kelas">Promkes A</p>
            </div>
            <div class="tm-back">
              <p class="tm-back-role">Penyusunan Laporan</p>
              <ul class="tm-back-tasks">
                <li>Menyusun laporan & referensi sumber</li>
                <li>Menyunting teks agar mudah dipahami</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- 5. Alisya Iskandar Putri – Desainer -->
        <div class="tm-card">
          <div class="tm-card-inner">
            <div class="tm-front">
              <div class="tm-photo-wrap">
                <img src="https://i.ibb.co.com/TBbyXbj9/ALISYA-ISKANDAR-PUTRI-jpg.jpg" alt="Alisya Iskandar Putri">
              </div>
              <p class="tm-nama">Alisya Iskandar Putri</p>
              <span class="tm-nim">G43250851</span>
              <p class="tm-kelas">Promkes A</p>
            </div>
            <div class="tm-back">
              <p class="tm-back-role">Desainer Visual</p>
              <ul class="tm-back-tasks">
                <li>Membuat desain tampilan & layout website</li>
                <li>Memilih palet warna & tipografi</li>
              </ul>
            </div>
          </div>
        </div>

      </div><!-- /.tm-grid -->
    </div><!-- /.tm-wrap -->
  </div>
</section>

<!-- LOGO INSTANSI BAWAH -->

<!-- FOOTER -->
<footer>
  <div style="margin-bottom:1rem;">
    <img src="img/logo_pol.jpeg" alt="Logo Polije" style="height:60px;  opacity:.85;" onerror="this.outerHTML='<span style=\'font-size:1.5rem;\'>🎓</span><span style=\'color:#e8ddd0; font-weight:700; margin-left:.5rem;\'>Politeknik Negeri Jember</span>'">
  </div>
  <p>
    <p style="margin-top:.4rem; font-size:.85rem; color:#ddd0c4;">
    &copy; 2026 <strong> CERNA – Promosi Kesehatan Kelas A</strong> &nbsp;|&nbsp;
    Politeknik Negeri Jember
  </p>
  <p style="margin-top:.4rem; font-size:.85rem; color:#ddd0c4;">
    ⚕️ Website ini bersifat edukatif.
  </p>
</footer>

<button id="btt" title="Kembali ke atas">↑</button>

<div id="logoutOverlay">

  <div class="logout-box">

    <div class="logout-loader"></div>

    <p>Keluar...</p>

  </div>

</div>
</div><!-- /#main-content -->

<script>

/* =========================================
   INIT WEBSITE
========================================= */
document.addEventListener('DOMContentLoaded', () => {

  // pastikan scroll aktif
  document.body.style.overflowX = 'hidden';
  document.body.style.overflowY = 'auto';

  initWebsiteScripts();

});


/* =========================================
   MAIN WEBSITE SCRIPT
========================================= */
function initWebsiteScripts() {

  /* =========================================
     FLIP CARD – tap support (mobile)
  ========================================= */
  document.querySelectorAll('.tm-card').forEach(card => {
    card.addEventListener('click', () => {
      card.classList.toggle('flipped');
    });
  });


  /* =========================================
     SEARCH
  ========================================= */
  const searchData = [
    {
      title: 'Gastritis',
      desc: 'Peradangan pada dinding lambung',
      section: 'news'
    },
    {
      title: 'Gejala',
      desc: 'Mual, muntah, nyeri ulu hati',
      section: 'gejala-page'
    },
    {
      title: 'Penyebab',
      desc: 'Merokok, pola makan, alkohol',
      section: 'penyebab'
    },
    {
      title: 'Penanganan',
      desc: 'Ubah pola makan dan gaya hidup',
      section: 'penanganan-page'
    },
    {
      title: 'Helicobacter pylori',
      desc: 'Bakteri penyebab gastritis',
      section: 'news'
    },
    {
      title: 'Kontak',
      desc: 'Hubungi kami untuk pertanyaan',
      section: 'contact'
    },
    {
      title: 'Tentang Kami',
      desc: 'Info tim pembuat website',
      section: 'about'
    }
  ];

  const searchInput   = document.getElementById('searchInput');
  const searchResults = document.getElementById('searchResults');

  if(searchInput){

    searchInput.addEventListener('input', (e) => {

      const query = e.target.value.toLowerCase().trim();

      if(query.length < 2){
        searchResults.classList.remove('active');
        return;
      }

      const filtered = searchData.filter(item =>
        item.title.toLowerCase().includes(query) ||
        item.desc.toLowerCase().includes(query)
      );

      if(filtered.length === 0){

        searchResults.innerHTML =
          `<div class="no-results">
            Tidak ada hasil pencarian
          </div>`;

      } else {

        searchResults.innerHTML = filtered.map(item => `
          <div class="search-result-item"
               onclick="scrollToSection('${item.section}')">

            <h4>${item.title}</h4>
            <p>${item.desc}</p>

          </div>
        `).join('');

      }

      searchResults.classList.add('active');

    });

  }

  document.addEventListener('click', (e) => {
    if(!e.target.closest('.search-box')){
      searchResults?.classList.remove('active');
    }
  });


  /* =========================================
     SCROLL TO SECTION
  ========================================= */
  window.scrollToSection = function(id){

    const target = document.getElementById(id);

    if(target){

      target.scrollIntoView({
        behavior:'smooth'
      });

    }

    searchResults?.classList.remove('active');

    if(searchInput){
      searchInput.value = '';
    }

  };


  /* =========================================
     HAMBURGER MENU
  ========================================= */
  const hamburger = document.getElementById('hamburger');
  const navLinks  = document.getElementById('navLinks');

  if(hamburger && navLinks){

    hamburger.addEventListener('click', () => {

      hamburger.classList.toggle('active');
      navLinks.classList.toggle('active');

    });

  }


  /* =========================================
     CLOSE MENU MOBILE
  ========================================= */
  document.querySelectorAll('.nav-links a').forEach(link => {

    link.addEventListener('click', () => {

      hamburger?.classList.remove('active');
      navLinks?.classList.remove('active');

    });

  });


  /* =========================================
     DROPDOWN
  ========================================= */
  const dropdownBtn     = document.getElementById('dropdownBtn');
  const dropdownContent = document.getElementById('dropdownContent');

  if(dropdownBtn && dropdownContent){

    dropdownBtn.addEventListener('click', (e) => {

      e.preventDefault();
      e.stopPropagation();

      dropdownBtn.classList.toggle('active');
      dropdownContent.classList.toggle('show');

    });

    document.addEventListener('click', (e) => {

      if(!e.target.closest('.dropdown-container')){

        dropdownBtn.classList.remove('active');
        dropdownContent.classList.remove('show');

      }

    });

  }


  /* =========================================
     SLIDER
  ========================================= */
  const slides = document.querySelectorAll('.slide');
  const dots   = document.querySelectorAll('.dot');

  if(slides.length > 0 && dots.length > 0){

    let current = 0;
    let sliderTimer;

    function goTo(index){

      slides[current].classList.remove('active');
      dots[current].classList.remove('active');

      current = (index + slides.length) % slides.length;

      slides[current].classList.add('active');
      dots[current].classList.add('active');

    }

    function startAuto(){

      sliderTimer = setInterval(() => {
        goTo(current + 1);
      }, 4500);

    }

    dots.forEach(dot => {

      dot.addEventListener('click', () => {

        clearInterval(sliderTimer);

        goTo(+dot.dataset.idx);

        startAuto();

      });

    });

    startAuto();

  }


  /* =========================================
     SMOOTH SCROLL NAV
  ========================================= */
  document.querySelectorAll('.nav-links a').forEach(link => {

    link.addEventListener('click', (e) => {

      const href = link.getAttribute('href');

      if(href && href.startsWith('#')){

        e.preventDefault();

        document.querySelector(href)?.scrollIntoView({
          behavior:'smooth'
        });

      }

    });

  });


  /* =========================================
     ACTIVE NAV SCROLL SPY
  ========================================= */
  const navSections = [
    {
      id:'home',
      link:document.querySelector('.nav-links a[href="#home"]')
    },
    {
      id:'news',
      link:document.querySelector('.nav-links a[href="#news"]')
    },
    {
      id:'gejala-page',
      link:document.querySelector('.nav-links a[href="#gejala-page"]')
    },
    {
      id:'penanganan-page',
      link:document.querySelector('.nav-links a[href="#penanganan-page"]')
    },
    {
      id:'contact',
      link:document.querySelector('.nav-links a[href="#contact"]')
    },
    {
      id:'about',
      link:document.querySelector('.nav-links a[href="#about"]')
    }
  ];

  function updateActiveNav(){

    let currentId = 'home';

    navSections.forEach(section => {

      const el = document.getElementById(section.id);

      if(el && window.scrollY >= el.offsetTop - 140){
        currentId = section.id;
      }

    });

    navSections.forEach(section => {

      if(section.link){

        section.link.classList.toggle(
          'active',
          section.id === currentId
        );

      }

    });

  }

  window.addEventListener('scroll', updateActiveNav);

  updateActiveNav();


  /* =========================================
     REVEAL ANIMATION
  ========================================= */
  const revealEls = document.querySelectorAll('.reveal');

  if(revealEls.length > 0){

    const revealObserver = new IntersectionObserver(entries => {

      entries.forEach(entry => {

        if(entry.isIntersecting){
          entry.target.classList.add('visible');
        }

      });

    }, {
      threshold:0.1
    });

    revealEls.forEach(el => {
      revealObserver.observe(el);
    });

  }


  /* =========================================
     BACK TO TOP
  ========================================= */
  const btt = document.getElementById('btt');

  if(btt){

    window.addEventListener('scroll', () => {

      btt.classList.toggle(
        'show',
        window.scrollY > 300
      );

    });

    btt.addEventListener('click', () => {

      window.scrollTo({
        top:0,
        behavior:'smooth'
      });

    });

  }

}



/* =========================================
   LOGOUT BUTTON
========================================= */

function handleLogout(){

localStorage.clear();

sessionStorage.clear();

document
.getElementById(
'logoutOverlay'
)
.classList.add(
'show'
);

setTimeout(()=>{

window.location.href=
"logout.php";

},1500);

}

</script>
</body>
</html>