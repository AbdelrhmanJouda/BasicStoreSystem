<?php include "include/header.php";

if(!isset($_SESSION['auth'])){
  header("location:index.php");
}
$data = json_decode(file_get_contents('validation/users.json'),true);
?>


<h1>Users page</h1>


<div class="container">
  <div class="row">
    <div class="col-12 mx-auto">

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Image</th>
      <th scope="col">Delete</th>
      <!-- <th scope="col">Edit</th> -->
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($data as $key => $value): ?>
    <tr>
      <th scope="row"><?= $i++ ?></th>
      <td><?= $value['name'] ?></td>
      <td><?= $value['email'] ?></td>
      <td>
        <img src="<?= BASE_URL."upload/".$value['image']?>" width="120" height="120" class="rounded-circle" alt="user img">
      </td>
      <td>
        <a href="handler/deleteuser.php?e=<?=$value['email']?>&img=<?=$value['image']?>" class="btn btn-danger">Delete</a>
      </td>
      <!-- <td>
        <a href="handler/edituser.php?e=//$value['email']" class="btn btn-success">Edit</a>
      </td> -->
    </tr>
    
   <?php endforeach; ?>
  </tbody>
</table>


    </div>
  </div>
</div>










<?php include "include/footer.php" ?>