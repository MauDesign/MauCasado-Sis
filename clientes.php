<?php 
//require_once "includes/redirect.php";
require_once "includes/side.php";

$clientes = mysqli_query($db, "SELECT * FROM clientes");
$proyectos = mysqli_query($db, "SELECT * FROM proyectos");
?>

<div class="col-md-12 col-lg-12 col-xl-12">
    <div class="card h-100">
              
                <div class="table-responsive text-nowrap">
                    <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Empresa</th>
                        <th>Telefono</th>
                        <th>Proyectos </th>
                    </tr>
                    </thead>    
                    <tbody class=""> 
                            
                        <?php while ($cliente = mysqli_fetch_assoc($clientes))  { 
                            $sql = "SELECT COUNT(*) AS total FROM proyectos WHERE cliente_id = {$cliente['cliente_id']}";
                            $proyectos = mysqli_query($db, $sql);
                            $proyectos = mysqli_fetch_assoc($proyectos);
                            //mostrar cero si no tiene prouectos
                            if($proyectos['total'] == null){
                                $proyectos['total'] = 0;
                            }

                        ?>
                            <tr>
                            <td><img class="circle responsive-img" width="50px" height="50px" 
                                src="uploads/<?php 
                                if ($cliente['imagen'] == null || $cliente['imagen'] == '') {
                                    echo "default.png";
                                } else {
                                    echo $cliente['imagen'];
                                }
                                
                                ?>" > </td>
                                <td><?= $cliente['cliente_id'] ?></td>
                                <td><a href="cliente.php?id=<?= $cliente['cliente_id']?>"><?= $cliente['nombre']. ' '.$cliente['apellido'] ?></a></td>
                                <td><?= $cliente['email'] ?></td>
                                <td><?= $cliente['empresa'] ?></td>
                                <td><?= $cliente['telefono'] ?></td>
                                <td><?= $proyectos['total'] ?></td>
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