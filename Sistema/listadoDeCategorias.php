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
            <li class="active"> Listado de Categorias </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
		  <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-tag"></i> Listado de Categorias </h3>
            </div>
            <div class="box-body">
			<?php 
			if(isset($_POST["Enviar"])){
				$estado=filtroInyeccion($_POST["estado"]);
				$id=filtroInyeccion($_POST["id"]);
				$sql="UPDATE categorias set estadoCategoria='$estado'  where id_categoria='$id' ";
 				$res=$mysqli->query($sql);
				?>
				<div class="callout callout-info">
                    <p>La modificacion se realizo Correctamente.</p>
                  </div>
				<?php
				}
				?>
				


			<?php 
			if(isset($_POST["Crear"])){
				$categoria=filtroInyeccion($_POST["categoria"]);
 				$sql="INSERT INTO  `categorias` (
					`id_categoria` ,
					`categoria` ,
					`estadoCategoria`
					)
					VALUES (
					NULL ,  '$categoria',  '1'
					); ";
 				$res=$mysqli->query($sql);
				?>
				<div class="callout callout-info">
                    <p>Se creo Correctamente.</p>
                  </div>
				<?php
				}
				?>
				
				
				<p>
				<form action="listadoDeCategorias.php" method="POST" style="
    width: 40%;
">
				<H2>Nombre de nueva Categoria: </H2>
  						<input type="text"  name="categoria" class="form-control">

						 <br>
						<button type="submit" class="btn btn-block btn-info" name="Crear"><i class="fa fa-fw fa-check"></i> Crear</button>
					 
						</form>
						</br>
						</p>
 			<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
					$sql="select * from categorias order by categoria asc
					";
					$res=$mysqli->query($sql);
					while($fila=mysqli_fetch_array($res)){
					?>
                      <tr>
                        <td><?php echo $fila["categoria"];?></td>
                        
                        <td> 
						<form action="listadoDeCategorias.php" method="POST">
						<?php if($fila["estadoCategoria"]=="1"){?>
						<button type="submit" class="btn btn-block btn-warning" name="Enviar"><i class="fa fa-fw fa-close"></i> Deshabilitar</button>
						<input type="hidden" value="0" name="estado">
						<input type="hidden" value="<?php echo $fila["id_categoria"];?>" name="id">

						<?php }else{?>
						<input type="hidden" value="1" name="estado">
						<input type="hidden" value="<?php echo $fila["id_categoria"];?>" name="id">
						<button type="submit" class="btn btn-block btn-info" name="Enviar"><i class="fa fa-fw fa-check"></i> Habilitar</button>
						<?php }?>
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