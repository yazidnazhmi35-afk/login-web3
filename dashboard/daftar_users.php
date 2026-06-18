 <?php
 include "../user.php";
 include "../database.php";

 $db = new Database();
 $conn = $db->connect();
 $user = new User($conn);

 $result = $user->getAllusers();
 $daftar_user = $result->fetch_all(MYSQLI_ASSOC);
 ?>
 
 
 
 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        
       
        <h2>Daftar Users</h2>
        <hr/>
        <a href="index.php?halaman=tambah_user_form.php" class="btn btn-primary">Tambah User</a>
        <div class="table-responsive small">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Asal</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            foreach($daftar_user as $user) {
                ?>
            
              <tr>
                <td><?php echo $user['id'];?></td>
                <td><?php echo $user['username'];?></td>
                <td><?php echo $user['email'];?></td>
                <td><?php echo $user['asal'];?></td>
                <td>
                    <a href = "delete_user.php?id=<?php echo $user['id'];?>">delete</a> 
                     <a href = "index.php?halaman=edit_user_form.php&id=<?php echo $user['id'];?>">edit</a>
              </tr>
              
              <?php
            }
            ?>
            </tbody>
          </table>
        </div>
      </main>