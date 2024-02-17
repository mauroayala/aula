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
            <li class="active"> Alta de Banner </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
		  <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-tag"></i> Alta de Banner </h3>
            </div>
            <div class="box-body">
			<?php 
			if(isset($_POST["Enviar"])){
				$titulo=filtroInyeccion($_POST["titulo"]);
 				$cuerpo=$_POST["cuerpo"];
				$link=$_POST["link"];
				$telefono=filtroInyeccion($_POST["telefono"]);
				$email=filtroInyeccion($_POST["email"]);
				$orden=filtroInyeccion($_POST["orden"]);
				$fecha=filtroInyeccion($_POST["fecha"]);
				$id_categoria=filtroInyeccion($_POST["id_categoria"]);
				$imagen=$_FILES['uploadImage']['name'];

				$sql="INSERT INTO  `publicidades` (
					`id_publicidad` ,
					`titulo` ,
					`cuerpo` ,
					`link` ,
					`id_estado_p` ,
					`telefono` ,
					`email`,
					`fecha`,
					`id_categoria`,
					`orden`
					)
					VALUES (
					NULL ,  '$titulo',  '$cuerpo',  '$link',  '1',  '$telefono',  '$email',  '$fecha',  '$id_categoria',  '$orden'
					);";
				
 				$res=$mysqli->query($sql);
			
				if($imagen!=""){
				 $sqlmax="select max(id_publicidad) as idmax from publicidades";
				 $resmax=$mysqli->query($sqlmax);
				 $filamax=mysqli_fetch_array($resmax);
				 $idmax=$filamax["idmax"];
				 
				upload_image('../imagenesPublicidad','uploadImage',$idmax.".jpg");
				}
				?>
				<div class="callout callout-info">
                    <p>La publicidad se cargo Correctamente.</p>
                  </div>
				<?php
				}
				?>
 		 
              <form action="altaDePublicidad.php" method="POST"  enctype="multipart/form-data" >
			       <div class="form-group">
                      <label for="titulo">Titulo</label>
                      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
                    </div>
					
						  <div class="form-group">  
	  <label for="titulo">Orden</label>  
		<SELECT class="form-control" id="orden" name="orden"  >
				<?php for($or=1;$or<=30;$or++){ ?>
				<option value="<?php echo $or;?>"><?php echo $or;?></option>	
				<?php  } ?>				
					</SELECT> 

	  </div>
	  
	  
					<div class="form-group">
                      <label for="titulo">Categoria</label>
                      <select class="form-control"  name="id_categoria">
					  <option value="0">Promo Banner Home</option>
					  <option value="3">Promo Banner Home CELULAR</option>
					  <option value="1">Promo Pie Productos</option>
					  </select>
                    </div>
					
					
			       <div class="form-group" style="display:none">
                      <label for="titulo">Fecha</label>
                      <input type="date" class="form-control" id="fecha" name="fecha" placeholder="">
                    </div> 

					<div class="form-group">
                      <label for="titulo">Link</label>
                      <input type="text" class="form-control" id="link" name="link" placeholder="">
                    </div> 
			       <div class="form-group" style="display:none">
                       <input type="hidden" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                    </div>
					<div class="form-group" style="display:none">
                       <input type="hidden" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
			 
			       <div class="form-group">
                      <label for="titulo">Segunda Linea</label>
                      <input type="text" class="form-control" id="cuerpo" name="cuerpo" >
                    </div>
					
					<div class="form-group">
                      <label for="titulo">Imagen</label>
					  <input type="file" id="archivo" class="input-file" accept="image/*" name="uploadImage" class="form-control">
                    </div>
					

										
										
			      <p>
 				<button type="submit" name="Enviar" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Crear Banner</button>
				</p>
			  </form>
             
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