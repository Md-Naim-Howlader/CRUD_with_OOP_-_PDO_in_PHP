<title>Create-CRUD with OOP & PDO in PHP</title>
<?php include "inc/header.php"?>
  <?php

  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
      $createMsg = $userManager->createNewUser($_POST);
    }
    ?>
<div class="card-header">
      <h3>Create User</h3>
    </div>
    <div class="card-body">
         <div class="ms-auto">
            <a href="index.php" class="btn-primary">All User</a>
         </div>
         <div class="alert-row">
          <?php
              if(isset($createMsg)) {
                echo $createMsg;
              }
          ?>
         </div>
      <form action="" method="post">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
        </div>
        <div class="form-group">
          <label for="skill">Skill:</label>
          <input type="text" name="skill" id="skill" class="form-control" placeholder="Enter your skills">
        </div>
        <button type="submit" name="create" class="btn-primary">Create User</button>
      </form>
    </div>