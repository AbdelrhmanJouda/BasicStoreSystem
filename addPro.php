<?php include "include/header.php";
include "functions/function.php";
if(!isset($_SESSION['auth'])){
    header("location:index.php");
  }
    
  $lastid = LastId('validation/products.json')+1;             // id

  $data = json_decode(file_get_contents("validation/products.json"),true);

?>


<h1>Add New Product page</h1>
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
    <!-- show message -->
    <?php if(isset($_SESSION['success'])): foreach($_SESSION['success'] as $success): ?>
      <div class="alert alert-success w-50 p-1 ">
       <p class="d-inline p-1"> <?= $success; ?> </p>
      </div>
      <?php endforeach; endif; unset($_SESSION['success']); ?>
    <!-- end message -->
                <!-- FORM START -->
      <form method="post" action="validation/proHandle.php" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label" >Name</label>
          <input name="name" type="text" placeholder="name" value="<?php if(isset($_SESSION['old'])): echo $_SESSION['old']['name']; endif;  ?>" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label" >ID</label>
          <input name="id" type="number" value="<?php echo $lastid ?>" placeholder="<?= $lastid ?>" disabled class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label" >price</label>
          <input name="price" type="text" value="<?php if(isset($_SESSION['old'])): echo $_SESSION['old']['price']; endif;  ?>" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label" >descriprion</label>
          <input name="discription" type="descriprion" value="<?php if(isset($_SESSION['old'])): echo $_SESSION['old']['discription']; endif; unset($_SESSION['old']); ?> " class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Image</label>
          <input name="image" type="file" class="form-control">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
          <!-- form end -->
    </div>
  </div>
</div>

<?php include "include/footer.php" ?>