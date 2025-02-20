
   <title>Home-CRUD with OOP & PDO in PHP</title>
    <?php include "inc/header.php"?>
  <?php

    // get delete user id
    if(isset($_GET['delid'])) {
      $id = $_GET['delid'];
      $delMsg = $userManager->deleteUser($id);
    }

?>
    <div class="card-header">
      <h3>CRUD with OOP and PDO in PHP</h3>
    </div>
    <div class="card-body">
     <div class="ms-auto">
       <a href="create.php" class="btn-primary">Create User</a>
     </div>
      <div class="alert-row">
          <?php
          session_start();
              if (isset($_SESSION['success'])) {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }

            if (isset($_SESSION['error'])) {
                echo  $_SESSION['error'];
                unset($_SESSION['error']);
            }
          ?>
         </div>
      <div class="table-container">

        <table>
          <thead>
            <tr>
              <th>Sl.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Skill</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $data = $userManager->getAllUser();

              if($data) {
                foreach ($data as $i => $value) { ?>
                     <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['email'] ?></td>
                        <td><?php echo $value['skill'] ?></td>
                        <td>
                          <a class="btn-warning" href="edit.php?id=<?php echo urlencode($value['id'])?>">Edit</a>
                          <a onClick='return confirm("Are You Sure to Delete Data ?")' class="btn-danger" href='?delid=<?php echo $value["id"]?>'>Delete</a>
                        </td>
                  </tr>
                <?php
                }
              }
          ?>
          </tbody>
        </table>
      </div>
  </div>
    <?php include "inc/footer.php"?>