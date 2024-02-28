<?php 

require_once "includes/side.php";

$users = mysqli_query($db, "SELECT * FROM users");
var_dump($users);
?>
<div class="col-md-12 col-lg-12 col-xl-12">
    <div class="card h-100">
              
            <div class="table-responsive text-nowrap">
                <table class="table">
                <thead class="teal accent-3">
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                </tr>
                </thead>    
                <tbody class="">      
                    <?php while ($user = mysqli_fetch_assoc($users)) { ?>
                        <tr>
                            <td><img src="uploads/<?= $user['imagen'] ?>" class="circle responsive-img" width="50px" height="50px"></td>
                            <td><a href="user.php?id=<?= $user['user_id']?>"><?= $user['nombre']. ' '.$user['apellido'] ?></a></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['rol'] ?></td>
                        </tr> 
                    <?php }?>
                    </tbody>
                </table>
            </div>
    </div>
</div>
<?php 
require_once "includes/footer.php";
?>