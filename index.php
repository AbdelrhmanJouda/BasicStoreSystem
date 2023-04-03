<?php include "include/header.php";
include "functions/function.php";
?>


<h1>Home page</h1>


<div class="container">
    <div class="row">
        <div class="col-12">
            <?php if(!isset($_SESSION['auth'])): ?>
            <div  class="mb-3">
                <a href="login.php">login</a>
            </div>
            <?php endif; ?>
<?php 




?>
        <div>
             <!-- show message -->
    <?php if(isset($_SESSION['success'])): foreach($_SESSION['success'] as $error): ?>
      <div class="alert alert-success w-50 p-1 ">
       <p class="d-inline p-1"> <?= $error; ?> </p>
       <?php endforeach; endif; unset($_SESSION['success']); ?>
      </div>
    <!-- end message -->
        </div>


        </div>
    </div>
</div>










<?php include "include/footer.php" ?>