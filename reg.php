<?php include "include/header.php";
if(!isset($_SESSION['auth'])){
  header("location:index.php");
}
?>


<h1>Registration page</h1>


<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
    <!-- show message -->
    <?php if(isset($_SESSION['errors'])): foreach($_SESSION['errors'] as $error): ?>
      <div class="alert alert-danger w-50 p-1 ">
       <p class="d-inline p-1"> <?= $error; ?> </p>
      </div>
      <?php endforeach; endif; unset($_SESSION['errors']); ?>
    <!-- end message -->
      <form method="post" action="validation/validation.php" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input name="name" type="text" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input name="email" type="text" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input name="password" type="password" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Confirm Password</label>
          <input name="Confirm_password" type="password" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Image</label>
          <input name="image" type="file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>
  </div>
</div>












<?php include "include/footer.php" ?>