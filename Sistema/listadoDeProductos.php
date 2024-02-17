<?php include('menu.php');?>

         <!-- DataTables -->

      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Home

            <small>Panel de Control</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active"> Listado de Producto </li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          

		  <div class="box box-primary">

            <div class="box-header">

              <h3 class="box-title"><i class="fa fa-tag"></i> Listado de Producto </h3>

            </div>

            <div class="box-body">

			<?php 

			if(isset($_POST["Enviar"])){

				$estado=filtroInyeccion($_POST["estado"]);

				$id=filtroInyeccion($_POST["id"]);

				$sql="UPDATE productos set estado='$estado'  where id_producto='$id' ";

 				$res=$mysqli->query($sql);

				?>

				<div class="callout callout-info">

                    <p>La modificacion se realizo Correctamente.</p>

                  </div>

				<?php

				}

				?>

				

						<?php 

			if(isset($_POST["Borrar"])){

				$id=filtroInyeccion($_POST["id"]);

				$sql="UPDATE productos set estado='3'  where id_producto='$id' ";

 				$res=$mysqli->query($sql);

				?>

				<div class="callout callout-danger">

                    <p>El Producto se borro Correctamente.</p>

                  </div>

				<?php

				}

				

							if(isset($_GET["mensaje"])){

				?>	

				<div class="callout callout-info">

                    <p>El Producto se cargo Correctamente.</p>

                  </div>

				<?php

				}

				?>

				

              <div class="col-md-6">
          <form action="listadoDeProductos.php" method="POST">


             <div class="form-group">  
                      <label for="titulo">Código</label> 
                      <input type="text" class="form-control" id="codigo" name="codigo" placeholder="codigo"> 
                    </div>
					
					
             <div class="form-group">  
                      <label for="titulo">Nombre</label> 
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"> 
                    </div>

                 <div class="form-group"> 
                      <label for="titulo">¿En Stock?</label> 
                      <select class="form-control" id="stock" name="stock"  >
                        <option value=""></option>
                        <option value="SI">Si</option>
                        <option value="NO">No</option>
                         </select> 
                    </div>

                 <div class="form-group"> 
                      <label for="titulo">Estado</label> 
                      <select class="form-control" id="estado" name="estado"  > 
                        <option value="1">Publicado</option>
                        <option value="2">Despublicado</option>
                         </select> 
                    </div>


               <div class="form-group" > 
                      <label for="titulo">Categoria</label> 
                      <SELECT class="form-control" id="categoria" name="categoria"  >
                       <option value=""></option>            <?php 
                      $sqlc="select * from categorias order by categoria asc";
                      $resc=$mysqli->query($sqlc);
                      while ($filac=mysqli_fetch_array($resc)) {
                        $idcategoriac= $filac["id_categoria"];
                        $categoriac= $filac["categoria"];
                    ?>
                        <OPTION VALUE="<?php echo $idcategoriac; ?>"><?php echo $categoriac; ?></OPTION>
                      
                      <?php
                      }
                        ?>
                      </SELECT>
                  </div>


        <div class="form-group">
          <button type="submit" name="Buscar" class="btn btn-success" value="Buscar"><i class="fa fa-fw fa-search"></i> Buscar</button>
        </div>
          </form>
          </div>

              <div class="col-md-12" style="clear: both;"></div>
<?php 

if (isset($_POST["Buscar"])) {

        $categoria=filtroInyeccion($_POST["categoria"]);
        $stock=filtroInyeccion($_POST["stock"]);
        $nombre=filtroInyeccion($_POST["nombre"]);
        $estado=filtroInyeccion($_POST["estado"]);
        $codigo=filtroInyeccion($_POST["codigo"]);
$and="";


if($estado!=""){
  $and.=" and estado='$estado' " ;
}

if($stock!=""){
  $and.=" and stock='$stock' " ;
}

if($codigo!=""){
  $and.=" and codigo='$codigo' " ;
}

if($nombre!=""){
  $and.=" and UPPER(nombre) like '%$nombre%' " ;
}

if($categoria!=""){
  $and.=" and categoria='$categoria' " ;
}
$sql="select * from productos where estado<>3 $and";
$res=$mysqli->query($sql);

?>
			<table id="example1" class="table table-bordered table-striped">

                    <thead>

                      <tr>

                        <th>Código</th>
                        <th>Nombre</th>

                        <th>Unidad/Botella</th>

                        <th>Precio</th>

                        <th>Estado</th>

                        <th>Accion</th>

                      </tr>

                    </thead>

                    <tbody>

					<?php 
					while($fila=mysqli_fetch_array($res)){

					?>

                      <tr>

                        <td><?php echo $fila["codigo"];?></td>
                        <td><?php echo $fila["nombre"];?></td>

                        <td><?php echo $fila["medidas"];?></td>

                        <td>$<?php echo $fila["precio"];?></td>

                        <td><?php if($fila["estado"]==1) { echo "Publicado";}

                            else{ echo "No Publicado";}
                        ?></td>

                        <td><form action="editarProducto.php" method="POST">

						<input type="hidden" value="<?php echo $fila["id_producto"];?>" name="id">

						<button class="btn btn-block btn-success"><i class="fa fa-fw fa-edit"></i> Editar</button>

						</form>

						

						<form action="listadoDeProductos.php" method="POST">

						<?php if($fila["estado"]==1){?>

						<button type="submit" class="btn btn-block btn-warning" name="Enviar"><i class="fa fa-fw fa-close"></i> Despublicar</button>

						<input type="hidden" value="2" name="estado">

						<input type="hidden" value="<?php echo $fila["id_producto"];?>" name="id">



						<?php }else{ ?>

						<input type="hidden" value="1" name="estado">

						<input type="hidden" value="<?php echo $fila["id_producto"];?>" name="id">

						<button type="submit" class="btn btn-block btn-info" name="Enviar"><i class="fa fa-fw fa-check"></i> Publicar</button>

						<?php }?>

						</form>

						</td>

                      </tr>

					  <?php

						}

					  ?>

                    </tfoot>

                  </table>
<?php } ?>
                

              

             </div><!-- /.box-body -->

          </div>

		  

		  

 

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

     <?php include("pie.php");?>

    <!-- DataTables -->

	<script src="plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

	

	  <script>

      $(function () {

        $("#example1").DataTable();

        $('#example2').DataTable({

          "paging": true,

          "lengthChange": false,

          "searching": false,

          "ordering": true,

          "info": true,

          "autoWidth": false

        });

      });

    </script>