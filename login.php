<?php include "include/header.php";

if(isset($_SESSION['auth'])){
  header("location:index.php");
}
?>


<h1>Login page</h1>


<div class="container">
  <div class="row">
    <div class="col-4  border rounded mx-auto">
       <!-- show message -->
    <?php if(isset($_SESSION['errors'])): foreach($_SESSION['errors'] as $error): ?>
      <div class="alert alert-danger w-50 m-1 p-1 ">
       <p class="d-inline p-1"> <?= $error; ?> </p>
      </div>
      <?php endforeach; endif; unset($_SESSION['errors']); ?>
    <!-- end message -->

      <form method="post" action="validation/logHandle.php">
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input name="email" type="email" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input name="password" type="password" class="form-control">
        </div>

        <button type="submit" class="mb-3 btn btn-primary">Submit</button>
      </form>


    </div>
  </div>
</div>










<?php include "include/footer.php" ?>