<?php 
print '<!-- Set navbar fixed top --> 

<nav class="navbar navbar-expand-sm bg-success navbar-dark fixed-top"> 
  <div class="container-fluid">

    <a class="navbar-brand" href="home.php">Home</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="lembur.php">Data Lembur</a>
        </li>	    

        <li class="nav-item">
        <a class="nav-link" href="laporan.php">Laporan</a>
      </li>	  

        <li class="nav-item">
          <a class="nav-link" href="/latihanaja/logout.php">Logout</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>';
?>