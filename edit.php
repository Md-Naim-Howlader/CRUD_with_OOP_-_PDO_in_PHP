<title>Edit-CRUD with OOP & PDO in PHP</title>
<?php include "inc/header.php"?>
  <?php

  if(isset($_GET['id'])){
    $id = $_GET['id'];

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
      $updateMsg = $userManager->updateUser($_POST,$id);
    }
    $user = $userManager->getUserById($id);
}
?>
<div class="card-header">
      <h3>Edit User</h3>
    </div>
    <div class="card-body">
         <div class="ms-auto">
            <a href="index.php" class="btn-primary">All User</a>
         </div>
         <div class="alert-row">
          <?php
              if(isset($updateMsg)) {
                echo $updateMsg;
              }
          ?>
         </div>
      <form action="" method="post">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" name="name" id="name" value="<?php echo $user->name ?>" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" value="<?php echo $user->email ?>" name="email" id="email" class="form-control" >
        </div>
        <div class="form-group">
          <label for="skill">Skill:</label>
          <input type="text" value="<?php echo $user->skill ?>" name="skill" id="skill" class="form-control" >
        </div>
        <button type="submit" name="update" class="btn-primary">Update User</button>
      </form>
    </div>