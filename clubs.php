<?php 
include 'includes/redirect.php';
require_once 'includes/side.php';


$clubs = mysqli_query($db, "SELECT * FROM clubs");

?>
<div class="container">
    <table class="striped responsive-table">
        <thead class="teal accent-3">
        <tr>
            <th></th>
            <th>Nombre del club</th>
            <th>Teléfono</th>
            <th>Canchas</th>
        </tr>
        </thead>    
        <tbody class="">      
            <?php while ($club = mysqli_fetch_assoc($clubs)) { ?>
                <tr>
                    <td><img src="uploads/<?= $club['imagen'] ?>" class="circle responsive-img" width="50px" height="50px"></td>
                    <td><a href="club.pho?id=<?= $club['club_id'] ?>"><?= $club['club_name'] ?></a></td>
                    <td><?= $club['phone'] ?></td>
                    <td><?= $club['Canchas'] ?></td>
                </tr> 
            <?php 

        var_dump($clubs);
        }?>
            </tbody>
        </table>
</div>
<?php 
require_once "includes/footer.php";
?>