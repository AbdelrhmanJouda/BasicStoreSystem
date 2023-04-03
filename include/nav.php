<?php session_start();
define("BASE_URL","http://127.0.0.1/eraasoft2/session9/ProductSys/");
?>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Product Sys 
    <?php if(isset($_SESSION['auth'])): foreach($_SESSION['LogedUser']as $name): foreach($_SESSION['logedImage'] as $img): ?>
          <span class="navbar-brand" href="products.php">: <?= $name ?>
        <img src="upload/<?= $img ?>" width="50px" height="50px" class="rounded-circle" alt="">
        </span>        
        <?php endforeach; endforeach; endif; ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      <li class="nav-item">
          <a class="nav-link " aria-current="page" href="index.php">Home</a>
        </li>
        <?php if(!isset($_SESSION['auth'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <?php endif; ?>
        <?php if(isset($_SESSION['auth'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="users.php">Users</a>
        </li>
        <?php endif; ?>
        <?php if(isset($_SESSION['auth'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="reg.php">Registration</a>
        </li>
        <?php endif; ?>
        <?php if(isset($_SESSION['auth'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="products.php">Products</a>
        </li>
        <?php endif; ?>

      
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

      <?php if(isset($_SESSION['auth'])): ?>
        <li class="nav-item">
          <a class="nav-link btn btn-light " href="logout.php">Logout</a>
        </li>
        <?php endif; ?>

      </ul>
    
    </div>
  </div>
</nav>