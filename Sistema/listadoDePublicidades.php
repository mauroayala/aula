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
            <li class="active"> Listado de Banneres </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
		  <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-tag"></i> Listado de Banneres </h3>
            </div>
            <div class="box-body">
			<?php 
			if(isset($_POST["Enviar"])){
				$estado=filtroInyeccion($_POST["estado"]);
				$id=filtroInyeccion($_POST["id"]);
				$sql="UPDATE publicidades set id_estado_p='$estado'  where id_publicidad='$id' ";
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
				$sql="UPDATE publicidades set id_estado_p='3'  where id_publicidad='$id' ";
 				$res=$mysqli->query($sql);
				?>
				<div class="callout callout-danger">
                    <p>El Banner se borro Correctamente.</p>
                  </div>
				<?php
				}
				?>
				
				
				<P><a href="altaDePublicidad.php" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Crear Banneres</a></P>
			<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Titulo</th>
                         <th>Estado</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
					$sql="select * from publicidades
					left join estados on (estados.id_estado=publicidades.id_estado_p)
					where id_estado_p<>'3'
					";
					$res=$mysqli->query($sql);
					while($fila=mysqli_fetch_array($res)){
					?>
                      <tr>
                        <td><?php echo $fila["titulo"];?></td>
                         <td><?php echo $fila["estado"];?></td>
                        <td><form action="editarPublicidad.php" method="POST">
						<input type="hidden" value="<?php echo $fila["id_publicidad"];?>" name="id">
						<button class="btn btn-block btn-success"><i class="fa fa-fw fa-edit"></i> Editar</button>
						</form>
						
						<form action="listadoDePublicidades.php" method="POST">
						<?php 
						if($fila["id_estado_p"]==1){ 
						?>
						<button type="submit" class="btn btn-block btn-warning" name="Enviar"><i class="fa fa-fw fa-close"></i> 
						Despublicar</button>
						<input type="hidden" value="2" name="estado">
						<input type="hidden" value="<?php echo $fila["id_publicidad"]; ?>" name="id">

						<?php 
						}
						else
						{
							?>
						<input type="hidden" value="1" name="estado">
						<input type="hidden" value="<?php echo $fila["id_publicidad"];?>" name="id">
						<button type="submit" class="btn btn-block btn-info" name="Enviar"><i class="fa fa-fw fa-check"></i> Publicar</button>
						<?php
						}
						?>
						</form>
						</td>
                      </tr>
					  <?php
						}
					  ?>
                    </tfoot>
                  </table>
                
              
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