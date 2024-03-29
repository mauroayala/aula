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
            <li class="active"> Listado de Examenes </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
		  <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-tag"></i> Listado de Examenes </h3>
            </div>
            <div class="box-body">
 

 
	 
					<?php 
					$sql="select * from examen where estado='1'
					";
					$res=$mysqli->query($sql);
					while($fila=mysqli_fetch_array($res)){
					?>
					
								 <div class="col-md-6">
					              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active" style="    background-color: #3c8dbc !important;">
                  <h3 class="widget-user-username"><?php echo $fila["titulo"];?></h3>
                  <h5 class="widget-user-desc"><?php echo $fila["descripcion"];?></h5>
                </div>
           
                <div class="widget-user-image">
                  <img class="img-circle" src="dist/img/user1-128x128.jpg" alt="User Avatar">
                </div>


                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">15</h5>
                        <span class="description-text">Preguntas</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">60</h5>
                        <span class="description-text">Minutos</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">Tipo</h5>
                        <span class="description-text">Diagnostico</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div>
				




                <div class="box-footer" style="text-align:center;">

                <?php 
                        $id_usuario=$_SESSION['idusuario'];

                    $id_examen=$fila["id_examen"];
                    $validoSiRespondio="select * from alumnos_examen where id_usuario='$id_usuario' and id_examen='$id_examen' ";
                    $resvalidoSiRespondio=$mysqli->query($validoSiRespondio);
 
                    $row=mysqli_num_rows($resvalidoSiRespondio);
                    if($row>0){
                      ?>
                   <form action="verExamen.php" method="POST"> 
                   <input type="hidden" name="id_examen" value="<?php echo $id_examen;?>">
                   <input type="submit" value="Ver Examen" class="btn btn-warning">
                   </form>
                  <?php 
                    }else{
                  ?>

				      	  <a class="btn btn-app" href="examen.php?id=<?php echo $id_examen;?>">
                    <i class="fa fa-file"></i> Realizar Examen
                  </a>

                  <?php }  ?>

 					     </div>

         
                    
              </div><!-- /.widget-user -->
			  
			                </div><!-- /.widget-user -->

 
			
			 
                      
					  <?php
						}
					  ?>
                   
				   
				   
				   
				   
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