<?php
// require_once "../conn.php";
if (isset($_POST['logout']))
  header("location:" . BASE_URL . "/admin/logout.php");
?>
<nav>
  <div class="navbar navbar-dark bg-dark justify-content-between top-nav">
    <div class="container">
      <ul class="d-flex text-white m-0">
        <li class="list-unstyled nav-link nav-item p-1 m-1">EXPRESS NEWS</li>
        <li class="list-unstyled nav-link nav-item p-1 m-1">URDU E-PAPER</li>
        <li class="list-unstyled nav-link nav-item p-1 m-1">ENGLISH 3-PAPER</li>
        <li class="list-unstyled nav-link nav-item p-1 m-1">SINDHI E-PAPER</li>
        <li class="list-unstyled nav-link nav-item p-1 m-1">CRICKET PAKISTAN </li>
        <li class="list-unstyled nav-link nav-item p-1 m-1">EXPRESS LIVE</li>
        <li class="list-unstyled nav-link nav-item p-1 m-1">CAMPS GURU</li>
        <li class="list-unstyled nav-link nav-item p-1 m-1">EXPRESS ENTERTAINMENT</li>
        <li class="list-unstyled nav-link nav-item p-1 m-1">FOOD TRUBIUNE</li>
      </ul>
      <ul class="d-flex text-white m-0">
        <li class="list-unstyled nav-link nav-item"><i class="fab fa-facebook-square fa-2x  m-0 p-0"></i></li>
        <li class="list-unstyled nav-link nav-item"><i class="fab fa-twitter fa-2x  m-0 p-0"></i></li>
        <li class="list-unstyled nav-link nav-item"><i class="fab fa-youtube fa-2x  m-0 p-0"></i></li>
      </ul>
    </div>
  </div>
  <div class="logo">
    <div class="container text-center">
      <div class="image text-center m-auto">
        <img src="./images/tribune-logo.webp" width="200px" height="100px" alt="">
      </div>
      <div class="links">
      <ul class="nav-links d-flex justify-content-center">
        <li class="list-unstyled m-1">Today's Paper |</li>
        <li class="list-unstyled m-1"><?= date("F d,Y");?> |</li>
        <li class="list-unstyled m-1">ADVERTISE</li> 
      </ul>
      </div>  
    </div>
  </div>
  <div class="main-nav">
    <div class="container">
      <ul class="main-navlinks d-flex justify-content-center m-0 p-0">
        <li class="list-unstyled m-1">Home</li>
        <li class="list-unstyled m-1">Latest</li>
        <li class="list-unstyled m-1">Pakitan</li>
        <li class="list-unstyled m-1">Buisness</li>
        <li class="list-unstyled m-1">Phone</li>
        <li class="list-unstyled m-1">World</li>
        <li class="list-unstyled m-1">Sci-Tech</li>
        <li class="list-unstyled m-1">Openion</li>
        <li class="list-unstyled m-1">Life & Style</li>
        <li class="list-unstyled m-1">T-Magazine</li>
        <li class="list-unstyled m-1">Sports</li>
        <li class="list-unstyled m-1">Cricket</li>
        <li class="list-unstyled m-1">Blog</li>
        <li class="list-unstyled m-1">Videos</li>
        <li class="list-unstyled m-1">Slideshow</li>
        <li class="list-unstyled m-1">Archive</li>
        <li class="list-unstyled m-1">Other</li>
      </ul>
    </div>
  </div>
</nav>