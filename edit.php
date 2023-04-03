
<?php include "include/header.php";
include "functions/function.php";
if(!isset($_SESSION['auth'])  ){
    header("location:index.php");
  
  }elseif(!isset($_SERVER['HTTP_REFERER'])){
    header("location:index.php");
  }
  elseif(isset($_GET['id'])){
$data = json_decode(file_get_contents("validation/products.json"),true);
  $upid = $_GET['id'];
  $img = $_GET['img'];
  $_FILES['image']['name'] = $_GET['img'];
  foreach($data as $row){
    if($row['id'] == $upid){
      $_SESSION['upId'] = $upid;
      // $_SESSION['image']=$img;
     
    }
  }
}


?>


<h1>Edit Product page</h1>
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
                <!-- FORM START -->
      <form method="post" action="validation/editHandle.php?img=<?=$img?>" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label" >Name</label>
          <input name="name" type="text" value="<?php if(isset($_SESSION['upId'])): echo $data[$upid-1]['name']; endif; ?>" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label" >ID</label>
          <input name="id" type="number" value="<?php if(isset($_SESSION['upId'])): echo $data[$upid-1]['id']; endif; ?>" placeholder="<?= $_GET['id'] ?> " disabled class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label" >price</label>
          <input name="price" type="text" value="<?php if(isset($_SESSION['upId'])): echo $data[$upid-1]['price']; endif; ?>" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label" >descriprion</label>
          <input name="discription" type="descriprion" value="<?php if(isset($_SESSION['upId'])): echo $data[$upid-1]['discription']; endif;?> " class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Image</label>
          <input name="image" type="file" value=" <?php if(isset($_SESSION['upId'])): echo $img; endif;?>" class="form-control">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="products.php" class="btn btn-danger" >Cancel</a>
      </form>
          <!-- form end -->
    </div>
  </div>
</div>

<?php include "include/footer.php" ?>

