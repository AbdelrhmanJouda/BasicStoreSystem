<?php include "include/header.php";
if(!isset($_SESSION['auth'])){
  header("location:index.php");
}
if(file_exists("validation/products.json")){
  $ProData = json_decode(file_get_contents('validation/products.json'),true);
}
?>


<h1>Products page</h1>


<div class="container">
  <div class="row">
    <div class=" col-12 ">
    <div class="mb-3">
      <a class="btn btn-primary " href="addPro.php">Add Product</a>
    </div>

    <!-- show message -->
    <?php if(isset($_SESSION['success'])): foreach($_SESSION['success'] as $error): ?>
      <div class="alert alert-success w-50 p-1 ">
       <p class="d-inline p-1"> <?php echo $error; ?> </p>
      </div>
      <?php endforeach; endif; unset($_SESSION['success']); ?>
    <!-- end message -->

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">ID</th>
      <th scope="col">price</th>
      <th scope="col">discription</th>
      <th scope="col">Image</th>
      <th scope="col">Delete</th>
      <th scope="col">Update</th>
    </tr>
  </thead>
  <tbody>
    <?php if(isset($ProData)): $i=1; foreach($ProData as $key => $value): ?>
    <tr>
      <th scope="row"><?= $i++ ?></th>
      <td><?= $value['name'] ?></td>
      <td><?= $value['id'] ?></td>
      <td><?= $value['price'] ?></td>
      <td><?= $value['discription'] ?></td>
      <td>
        <img src="<?php echo BASE_URL."upload/products/".$value['image'];?>" width="150" height="150" alt="img">
      </td>
      <td>
          <a href="<?php echo BASE_URL."handler/delete.php?id=".$value['id']."&img=".$value['image']; ?>" class="btn btn-danger">Delete</a>
        </td>
        <td>
          <a href="<?php echo BASE_URL."edit.php?id=".$value['id']."&name=".$value['name']."&price=".$value['price']."&disc=".$value['discription']."&img=".$value['image']; ?>" class="btn btn-success">Edit</a>
         </td>
    </tr>
    
   <?php endforeach; endif; ?>
  </tbody>
</table>


    </div>
  </div>
</div>

<?php include "include/footer.php" ?>